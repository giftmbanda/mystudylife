<?php

namespace App\Http\Controllers;

use File;
use Auth;
use Storage;
use Response;
use Validator;
use Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Subject;
use App\Models\Venue;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use App\Models\StudentAttendance;
use App\Models\LectureAttendance;
use jeremykenedy\LaravelRoles\Models\Role;

// Forgot password
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

use Google\Cloud\Translate\TranslateClient;

class UserController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->isAdministrator()) {

            // $translations = Translation::all();
            $users = User::all();

            // // Total Translations this week
            // $weeklyTranslations = $translations->filter(function($trans, $key) {
            //     $predicateO = $trans->created_at->gte(Carbon::today()->startOfWeek());
            //     $predicateT = $trans->created_at->lte(Carbon::today()->endOfWeek());
            //     return  $predicateO && $predicateT;
            // })->count();

            // $weeklyUsers = $users->filter(function($user, $key) {
            //     $predicateO = $user->created_at->gte(Carbon::today()->startOfWeek());
            //     $predicateT = $user->created_at->lte(Carbon::today()->endOfWeek());
            //     return  $predicateO && $predicateT;
            // })->count();

            $data = [
                'lectures' => User::where('user_type', User::USER_TYPE_LECTURE)->count(),
                'students' => User::where('user_type', User::USER_TYPE_STUDENT)->count(),
                'attendances' => StudentAttendance::all()->count(),
                'users' => $users->filter(function ($user) {
                    return $user->u_id !== Auth::user()->u_id;
                })
            ];

            return view('pages.admin.home', $data);  

        } else if ($user->isLecture()) {

            $subjects = $user->subjects;
    
            foreach($subjects as $subject) {
                $subject->_number_of_attendances = $subject->number_of_attendances ? $subject->number_of_attendances : "---";
                $subject->_total_classes = $subject->number_of_attendances ? (\Auth::user()->attendanceForSubject($subject->s_id)->count() ."/". $subject->number_of_attendances) : "---";
                $subject->_percentage = $this->calculatePercentage(\Auth::user()->attendanceForSubject($subject->s_id)->count(), $subject->number_of_attendances);
            }
            
            $data = [
                'subjects' => $subjects,
                'attendances' => $user->attendances,
            ];

            return view('pages.lecture.home', $data);
        }

        $subjects = $user->course ? $user->course->course->subjects : collect([]);
        $course = $user->course ? $user->course->course : collect([]);


        foreach($subjects as $subject) {
            $subject->_number_of_attendances = $subject->number_of_attendances ? $subject->number_of_attendances : "---";
            $subject->_total_classes = $subject->number_of_attendances ? (\Auth::user()->attendanceForSubject($subject->s_id)->count() ."/". $subject->number_of_attendances) : "---";
            $subject->_percentage = $this->calculatePercentage(\Auth::user()->attendanceForSubject($subject->s_id)->count(), $subject->number_of_attendances);
        }

        $data = [
            'course' => $course,
            'subjects' => $subjects,
            'attendances' => $user->attendances,
        ];

        return view('pages.user.home', $data);
    }

    function calculatePercentage($value, $total)
    {
        if ($total) {
            $percentChange = ($value / $total) * 100;
            return round(abs($percentChange));
        }

        return 0;
    }

    public function getProfileUrl(Request $request)
    {
        $path = Storage::disk('local')->path("profiles/" . Auth::user()->profile_picture);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();

        // dd($user);
        return view('pages.user.profile')->withUser($user);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAttend(Request $request, $subjectID)
    {
        $user = Auth::user();
        $subject = Subject::findOrFail($subjectID);

        $data = [
            "user" => $user,
            "venue" => $subject->venue,
            "subject" => $subject
        ];

        return view('pages.attend', $data);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doAttend(Request $request, $subjectID)
    {
        $user = Auth::user();
        
        $subject = Subject::findOrFail($subjectID);

        if ($user->isUser()) {
            // Lets create a student attendance
            StudentAttendance::create([
                'u_id' => Auth::user()->u_id,
                's_id' => $subject->s_id
            ]);
        }

        if ($user->isLecture()) {
            // Lets create a student attendance
            LectureAttendance::create([
                'u_id' => Auth::user()->u_id,
                's_id' => $subject->s_id
            ]);
        }

        return redirect('/dashboard')->with('success', 'Successfully logged your attendance');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showOrders()
    {
        $user = Auth::user();

        return view('pages.user.404')->withUser($user);
    }  
    
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTickets()
    {
        $user = Auth::user();

        return view('pages.user.404')->withUser($user);
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        $user = Auth::user();

        if ($user->isAdministrator()) {
            $translations = Translation::all();
            $users = User::where('user_type', 2)->get();

            // Total Translations this week
            $weeklyTranslations = $translations->filter(function($trans, $key) {
                $predicateO = $trans->created_at->gte(Carbon::today()->startOfWeek());
                $predicateT = $trans->created_at->lte(Carbon::today()->endOfWeek());
                return  $predicateO && $predicateT;
            })->count();

            $weeklyUsers = $users->filter(function($user, $key) {
                $predicateO = $user->created_at->gte(Carbon::today()->startOfWeek());
                $predicateT = $user->created_at->lte(Carbon::today()->endOfWeek());
                return  $predicateO && $predicateT;
            })->count();

            $maleUsers = $users->filter(function($user, $key) {
                return  ($this->getGender($user->id_number) == 'M');
            });

            $femaleUsers = $users->filter(function($user, $key) {
                return  ($this->getGender($user->id_number) == 'F');
            });

            $mostTranslatedWords = $translations->groupBy('original_text');

            $users->each(function($user) {
                $user->gender = $this->getGender($user->id_number);
            });

            $data = [
                'translations' => $translations,
                'mostTranslatedWords' => $mostTranslatedWords,
                'allTranslations' => $translations->count(),
                'weeklyTranslations' => $weeklyTranslations,
                'weeklyUsers' => $weeklyUsers,
                'maleUsers' => $maleUsers,
                'femaleUsers' => $femaleUsers,
                'users' => $users,
                'allUsers' => $users->count(),
            ];

            return view('pages.admin.report', $data);
        } else {
         
            $weeklyTranslations = $user->translations->filter(function($trans, $key) {
                $predicateO = $trans->created_at->gte(Carbon::today()->startOfWeek());
                $predicateT = $trans->created_at->lte(Carbon::today()->endOfWeek());
                return  $predicateO && $predicateT;
            })->count();

            $mostTranslatedWords = $user->translations->groupBy('original_text');

            $data = [
                'translations' => $user->translations,
                'allTranslations' => $user->translations->count(),
                'mostTranslatedWords' => $mostTranslatedWords,
                'weeklyTranslations' => $weeklyTranslations,
            ];

            return view('pages.user.report', $data);
        }
    }


    public function showTranslate()
    {
        $user = Auth::user();
        $languages = collect([]);

        $en = new \StdClass;
        $en->key = 'en';
        $en->label = 'English';
        $languages->push($en);

        $zu = new \StdClass;
        $zu->key = 'zu';
        $zu->label = 'Zulu';
        $languages->push($zu);

        $st = new \StdClass;
        $st->key = 'st';
        $st->label = 'Sesotho';
        $languages->push($st);

        $data = [
            'languages' => $languages,
            'translations' => $user->translations
        ];

        if ($user->isAdministrator()) {
            
            $data['translations'] = Translation::all();

            return view('pages.admin.translate', $data);    
        }

        return view('pages.user.translate', $data);
    }

    public function doCreateTranslation(Request $request)
    {
        $rules = [
            'from_language'     => 'required',
            'to_language'       => 'required',
            'original_text'     => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 400);
        }

        # The text to translate
        $text = $request->input('original_text');

        # The target language
        $target = $request->input('to_language');

        # The source language
        $source = $request->input('from_language');

        if ($target == $source) {
            return response()->json(['errors' => ['Please try not to select the same language for both filters']], 400);
        }
        
        // Ttranslation codes [ st => Sesotho, en => English, zu => Zulu]

        # Your Google Cloud Platform project ID
        $projectId = 'tut-translation-system';

        # Instantiates a client
        $translate = new TranslateClient([
            'projectId' => $projectId
        ]);

        # Translates some text into Russian
        $gTranslation = $translate->translate($text, [
            'target' => $target,
            'source' => $source,
            'key'    => config('services.google.api_key')
        ]);

        $orignalText    = $gTranslation['input'];
        $translatedText = $gTranslation['text'];
        $fromLanguage   = $source;
        $toLanguage     = $target;

        $translation = Translation::create([
            'user_id'           => Auth::user()->id,
            'from_language'     => $fromLanguage,
            'to_language'       => $toLanguage,
            'original_text'     => $orignalText,
            'translated_text'   => $translatedText,
            'translatable'      => !$this->isSame($orignalText, $translatedText)
        ]);

        // We need to check the existing translations if the request is not translatable
        if ($this->isSame($orignalText, $translatedText)) {
            
            $tmp = Translation::where('from_language', $fromLanguage)
                        ->where('to_language', $toLanguage)
                        ->where('original_text', $orignalText)
                        ->where('translatable', 0)
                        ->where('suggestion_approved', 1)
                        ->first();

            $translation->suggested_text = $tmp->suggested_text;
            $translation->suggestion_approved = 1;
            $translation->save();
        }

        return response()->json([
            'message'     => 'Successfully update your translation.',
            'translation' => $translation,
            'translations' => Auth::user()->translations,
        ], 200);
    }

    public function isSame($original, $translated) {

        return (strtolower($original) == strtolower($translated));
    }
    
    public function doCreateTranslationSuggestion(Request $request) {
        
        $rules = [
            'suggested_text'   => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 400);
        }

        $translation = Translation::findOrFail($request->input('translation_id'));

        $translation->suggested_text = $request->input('suggested_text');
        $translation->save();

        return response()->json([
            'translation' => $translation,
            'translations' => Auth::user()->translations,
            'message'     => 'Successfully updated your translation.',
        ], 200);
    }

    public function doApproveTranslationSuggestion(Request $request) {
        
        $translation = Translation::findOrFail($request->input('translation_id'));

        $translation->suggestion_approved = $request->input('is_approved') == true ? 1 : 0;
        $translation->save();

        return response()->json([
            'translation' => $translation,
            'translations' => Translation::all(),
            'message'     => 'Successfully updated translation.',
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        $data = [
            'user' => $user,
            'canEditSurname' => ($this->getGender($user->id_number) == 'F')
        ];

        return view('pages.user.edit', $data);
    }

    public function getGender($idNumber) {
                    
        if ($idNumber == "") {
            return null;
        }

        $gender = substr($idNumber, 6, 4);
        $dob    = substr($idNumber, 0, 6);
        $isMale = null;
            
        if ($gender >= 0000 && $gender <= 4999) {
            $isMale = false;
        } else if ($gender >= 5000 && $gender <= 9999) {
            $isMale = true;
        }

        return $isMale ? 'M' : 'F';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }

        if (isset($data['profile_picture'])) {
            $file = $data['profile_picture'];
            $name = uniqid() . "." . $file->getClientOriginalExtension();
            $path = "/profiles/" . $name;
            Storage::disk('local')->put($path, file_get_contents($data['profile_picture']));
            $user->profile_picture = $name;
        }

        $user->save();

        return back()->with('success', trans('usersmanagement.updateSuccess'));
    }   
}