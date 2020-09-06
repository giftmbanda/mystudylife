<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;
use App\Models\Subject;
use App\Models\StudentCourse;
use App\Models\LectureSubject;

class UsersManagementController extends Controller
{
    protected $roles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $roles = collect([]);

        $role = new \StdClass;
        $role->id = 1;
        $role->name = 'Admin';
        $role->slug = 'Admin';
        $roles->push($role);

        $role = new \StdClass;
        $role->id = 2;
        $role->name = 'Student';
        $role->slug = 'Student';
        $roles->push($role);

        $role = new \StdClass;
        $role->id = 3;
        $role->name = 'Lecture';
        $role->slug = 'Lecture';
        $roles->push($role);

        $this->roles = $roles;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = $this->roles;
        
        return View('usersmanagement.show-users', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roles;
        
        $data = [
            'roles' => $roles,
            'courses' => Course::all(['c_id', 'name']),
            'subjects' => Subject::all(['s_id', 'name']),
        ];

        return view('usersmanagement.create-user')->with($data);
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
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|email|max:255|unique:User',
            'password'              => 'required|min:6|max:20|confirmed',
            'password_confirmation' => 'required|same:password',
            'role'                  => 'required',
            'id_number'             => [
                'required', 'max:13', 'unique:User', 
                function ($attribute, $value, $fail) {
                    if ($this->getAge($value) < 16) {
                        $fail('User needs to be at least 16 years or older.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if ($this->isFuture($value)) {
                        $fail('Future ID numbers are invalid.');
                    }
                }
            ]
        ];

        $messages = [
            'first_name.required'   => trans('auth.fNameRequired'),
            'last_name.required'    => trans('auth.lNameRequired'),
            'email.required'        => trans('auth.emailRequired'),
            'email.email'           => trans('auth.emailInvalid'),
            'password.required'     => trans('auth.passwordRequired'),
            'password.min'          => trans('auth.PasswordMin'),
            'password.max'          => trans('auth.PasswordMax'),
            'role.required'         => trans('auth.roleRequired'),
            'id_number.required'    => 'Please enter ID Number',
        ];

        if ($request->has('role')) {
            
            if ($request->input('role') == User::USER_TYPE_STUDENT) {
                $rules['course'] = 'required';
                $messages['course.required'] = 'Please select course for this student';
            }
            
            if ($request->input('role') == User::USER_TYPE_LECTURE) {
                $rules['subject'] = 'required';
                $messages['subject.required'] = 'Please select subject for this lecture';
            }
        }

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'first_name'        => $request->input('first_name'),
            'last_name'         => $request->input('last_name'),
            'email'             => $request->input('email'),
            'password'          => bcrypt($request->input('password')),
            'user_type'         => $request->input('role'),
            'id_number'         => $request->input('id_number'),
        ]);

        // Assign Student A course
        if (isset($data['course']) && $request->input('role') == User::USER_TYPE_STUDENT) {
            StudentCourse::create([
                'u_id' => $user->u_id,
                'c_id' => $data['course']
            ]);
        }
        
        // Assign Lecture a subject
        if (isset($data['subject']) && $request->input('role') == User::USER_TYPE_LECTURE) {
            LectureSubject::create([
                'u_id' => $user->u_id,
                's_id' => $data['subject']
            ]);
        }
        
        return redirect('users')->with('success', trans('usersmanagement.createSuccess'));
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
        $user = User::find($id);

        if ($user->isUser()) {
            $subjects = $user->course ? $user->course->course->subjects : collect([]);
            $course = $user->course ? $user->course->course : collect([]);

            foreach($subjects as $subject) {
                $subject->_number_of_attendances = $subject->number_of_attendances ? $subject->number_of_attendances : 0;
                $subject->_total_classes = $subject->number_of_attendances ? ($user->attendanceForSubject($subject->s_id)->count() ."/". $subject->number_of_attendances) : 0;
                $subject->_total_classes_value = $subject->number_of_attendances ? $user->attendanceForSubject($subject->s_id)->count() : 0;
                $subject->_percentage = $this->calculatePercentage($user->attendanceForSubject($subject->s_id)->count(), $subject->number_of_attendances);
            }

            $value = $subjects->sum('_total_classes_value');
            $total = $subjects->sum('_number_of_attendances');
            $attendancePercentage = $this->calculatePercentage($value, $total);

            $data = [
                'course' => $course,
                'subjects' => $subjects,
                'attendances' => $user->attendances,
                'attendancePercentage' => $attendancePercentage
            ];

            return view('usersmanagement.show-student', $data)->withUser($user);
        } else {
            return view('usersmanagement.show-user')->withUser($user);
        }
    }

    function calculatePercentage($value, $total)
    {
        if ($total) {
            $percentChange = ($value / $total) * 100;
            return round(abs($percentChange));
        }

        return 0;
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
        $user = User::findOrFail($id);
        $roles = $this->roles;

        $currentRole = $this->roles->filter(function($role) use ($user) {
            return $user->user_type == $role->id;
        })->first();

        $course = $user->course;

        $data = [
            'currentCourse' => $course,
            'user'          => $user,
            'roles'         => $roles,
            'currentRole'   => $currentRole,
            'courses'       => Course::all(['c_id', 'name']),
        ];

        return view('usersmanagement.edit-user')->with($data);
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
        $currentUser = Auth::user();
        $user = User::find($id);
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);

        if ($emailCheck) {
            $validator = Validator::make($request->all(), [
                'email'     => 'email|max:255|unique:User',
                'password'  => 'present|confirmed|min:6',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'password'  => 'nullable|confirmed|min:6',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }

        // if ($request->input('id_number') != null) {
        //     $user->id_number = $request->input('id_number');
        // }

        if ($request->input('role') != null) {
            $user->user_type = $request->input('role');
        }

        if ($request->input('course') != null && $user->isUser()) {

            if (!$user->course) {
                StudentCourse::create([
                    'u_id' => $user->u_id,
                    'c_id' => $request->input('course')
                ]);
            } else {
                $user->course->c_id = $request->input('course');
                $user->course()->save();
            }
        }

        $user->save();

        return back()->with('success', trans('usersmanagement.updateSuccess'));
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
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        if ($user->u_id != $currentUser->u_id) {
            
            // Lets delete the course that is linked to this user
            if ($user->course) {
                $user->course()->delete();
            }
            
            if ($user->subjects) {
                $user->subjects()->delete();
            }
            
            if ($user->attendances) {
                $user->attendances()->delete();
            }

            $user->forceDelete();
            return redirect('users')->with('success', trans('usersmanagement.deleteSuccess'));
        }

        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }

    /**
     * Returns birth date from identity
     *
     * @param string $identity Identity string
     * 
     * @return \DateTime
     */
    function getBirthDateFromIdentity($identity) {
        // substring identity to get bday
        $date = substr($identity, 0, 6);

        // use built-in DateTime object to work with dates
        $date = \DateTime::createFromFormat('ymd', $date);
        $now  = new \DateTime();

        // compare birth date with current date: 
        // if it's bigger bd was in previous century
        if ($date > $now) {
            $date->modify('-100 years');
        }

        return $date;
    }

    /**
     * Returns true or false depending on the provided ID Number
     *
     * @param string $identity Identity string
     * 
     * @return \DateTime
     */
    function isFuture($identity) {
        // substring identity to get bday
        $date = substr($identity, 0, 6);

        // use built-in DateTime object to work with dates
        $date = \DateTime::createFromFormat('ymd', $date);
        $now  = new \DateTime();

        // compare birth date with current date: 
        // if it's bigger bd was in previous century
        if ($date > $now) {
            return true;
        }

        return false;
    }

    /**
     * Returns gender string from identity
     *
     * @param string $identity Identity string
     * 
     * @return string
     */
    function getGenderFromIdentity($identity) {
        // substring gender data and convert it to int
        $gender = (int) substr($identity, 6, 1);
        return ($gender >= 0 && $gender <= 4) ? 'Female' : 'Male';
    }

    /**
     * Returns age from birthdate (on 31 December of the current year)
     *
     * @param \DateTime $birthdate Birth date
     * 
     * @return int
     */
    function getAgeFromBirthday(\DateTime $birthdate) {
        $date = new \DateTime();
        $interval = $date->diff($birthdate);
        return $interval->y;
    }

    function getAge($value) {
        $birthdate = $this->getBirthDateFromIdentity($value);
        return $this->getAgeFromBirthday($birthdate);
    }

}
