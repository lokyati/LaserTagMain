<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UsersStat;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        //$this->middleware('guest:admin');
        //$this->middleware('guest:user');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:15|min:5',
            'email' => 'required|string|email|max:15|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function messages()
    {
        return [
            'name.required' => 'Kötelező kitölteni!',
            'email.required'  => 'Kötelező kitölteni!',
            'password.required'  => 'Kötelező kitölteni!',
            'email.email' => 'Az emailnek valós cimnek kell lennie!',
            'password.confirmed' => 'A jelszavak nem egyeznek!',
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'lvl' => $data['lvl'],
            'battle_point_balance' => $data['battle_point_balance']
        ]);

        UsersStat::create([
            'user_id' => $user->id
        ]);

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user); //nem jelentkezik be azonnal ha ki van kommentelve

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
