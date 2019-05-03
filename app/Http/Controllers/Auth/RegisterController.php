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
            'email' => 'required|string|email|max:20|unique:users',
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
            'battle_points' => $data['battle_points'],
            'rank_id' => $data['rank_id'],
        ]);

        UsersStat::create([
            'user_id' => $user->id,
            'experience' => $data['experience'],
            'lvl' => $data['lvl'],
            'all_shot' => $data['all_shot'],
            'all_hit' => $data['all_hit'],
            'all_out' => $data['all_out'],
            'matches' => $data['matches'],
            'wins' => $data['wins'],
            'loses' => $data['loses'],
            'bestplace' => $data['bestplace'],
            'avg_shot' => $data['avg_shot'],
            'avg_acc' => $data['avg_acc'],
            'avg_hit' => $data['avg_hit'],
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
