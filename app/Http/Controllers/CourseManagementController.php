<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Venue;
use App\Models\Subject;
use Auth;
use Illuminate\Http\Request;
use Validator;
use App\Models\StudentCourse;

class CourseManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
    
        return View('coursesmanagement.show-courses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coursesmanagement.create-course');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $rules = [
            'name'  => 'required',
            'code'  => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $course = Course::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ]);
        
        return redirect('courses')->with('success', "Successfully created");
    }

    /**
     * Create a new Venue.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function doCreateVenue(Request $request)
    {

        $data = $request->all();

        $rules = [
            'name' => "required",
            'location' => "required",
            'latitude' => "required",
            'longitude' => "required",
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $course = Venue::create([
            'name' => $request->input("name"),
            'location' => $request->input("location"),
            'latitude' => $request->input("latitude"),
            'longitude' => $request->input("longitude"),
        ]);
        
        return redirect('venues')->with('success', "Successfully created");
    }

    /**
     * update a Venue.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function doUpdateVenue(Request $request, $id)
    {

        $data = $request->all();

        $rules = [
            'name' => "required",
            'location' => "required",
            'latitude' => "required",
            'longitude' => "required",
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $course = Venue::findOrFail($id);

        $course->name       = $request->has("name")      ? $request->input("name")      : $course->name;
        $course->location   = $request->has("location")  ? $request->input("location")  : $course->location;
        $course->latitude   = $request->has("latitude")  ? $request->input("latitude")  : $course->latitude;
        $course->longitude  = $request->has("longitude") ? $request->input("longitude") : $course->longitude;
        
        $course->save();
        
        return redirect('venues')->with('success', "Successfully udpated");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function showVenues()
    {
        $venues = Venue::all();

        return view('coursesmanagement.show-venues', [
            'venues' => $venues
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateVenue(Request $request)
    {
        return view('coursesmanagement.create-venue');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateSubject(Request $request, $courseID)
    {
        $course = Course::findOrFail($courseID);
        $venues = Venue::all();

        return view('coursesmanagement.create-subject', [
            'course' => $course,
            'venues' => $venues
        ]);
    }
    
    /**
     * Create a new Venue.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function doCreateSubject(Request $request, $courseID)
    {

        $data = $request->all();

        $rules = [
            'name' => "required",
            'code' => "required",
            'semester' => "required",
            'venue' => "required",
            'session_time' => "required",
            'number_of_classes' => "required",
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Subject::create([
            'name' => $request->input("name"),
            'code' => $request->input("code"),
            'semester' => $request->input("semester"),
            'number_of_attendances' => $request->input("number_of_classes"),
            'session_date' => \Carbon\Carbon::createFromFormat("H:i", $request->input("session_time")),
            'v_id' => $request->input("venue"),
            'c_id' => $courseID,
        ]);
        
        return redirect('courses')->with('success', "Successfully Created Subject");
    }

    /**
     * Create a new Venue.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function doUpdateSubjectTime(Request $request, $id)
    {

        $data = $request->all();

        $rules = [
            'session_time' => "required",
            'number_of_classes'  => "required"
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $subject = Subject::findOrFail($id);
        $subject->session_date = \Carbon\Carbon::createFromFormat("H:i", $request->input("session_time"));
        $subject->number_of_attendances = $request->input("number_of_classes");

        $subject->save();
        
        return redirect()->back()->with('success', "Successfully Updated Subject");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function showUpdateVenue(Request $request, $id)
    {
        $venue = Venue::find($id);

        return view('coursesmanagement.edit-venue', [
            "venue" => $venue
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);

        return view('coursesmanagement.show-course', [
            "course" => $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        $data = [
            'course'        => $course
        ];

        return view('coursesmanagement.edit-course')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if ($request->input('name') != null) {
            $course->name = $request->input('name');
        }

        if ($request->input('code') != null) {
            $course->code = $request->input('code');
        }

        $course->save();

        return back()->with('success', "Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Lets delete the subjects that is linked to this course
        if ($course->subjects) {
            $course->subjects()->delete();
        }

        if ($course->students) {
            $course->students()->delete();
        }

        $course->forceDelete();
        return redirect('courses')->with('success', "Deleted Successfully");
    }
}
