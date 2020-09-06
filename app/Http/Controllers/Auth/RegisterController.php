<?php

namespace App\Http\Controllers\Auth;

use Storage;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentCourse;
use App\Traits\ActivationTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use ActivationTrait;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', [
            'except' => 'logout',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
            [
                'first_name'            => 'required|min:4',
                'last_name'             => 'required|min:4',
                'course_id'             => 'required',
                'id_number'             => [
                    'required', 'min:13', 'max:13', 'unique:User', 
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
                ],
                'email'                 => 'required|email|max:255|unique:User',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                "profile_picture"       => 'max:1024', // (max size 1 MB)
            ]
        );
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
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'],
            'password'          => bcrypt($data['password']),
            'user_type'         => User::USER_TYPE_STUDENT,
            'id_number'         => $data['id_number'],
        ]);

        if (isset($data['profile_picture'])) {
            $file = $data['profile_picture'];
            $name = uniqid() . "." . $file->getClientOriginalExtension();
            $path = "/profiles/" . $name;
            Storage::disk('local')->put($path, file_get_contents($data['profile_picture']));
            $user->profile_picture = $name;
        }
        
        $user->save();

        // Lets create a link between this user and the selected course
        if (isset($data['course_id'])) {
            StudentCourse::create([
                'u_id' => $user->u_id,
                'c_id' => $data['course_id']
            ]);
        }

        return $user;
    }
}
