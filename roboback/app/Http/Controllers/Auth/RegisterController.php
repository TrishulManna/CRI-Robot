<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Organisation;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:50|unique:users,email,' . $data['email'],
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'required|max:25',
            'address' => 'required|max:100',
            'organisation_id' => 'max:50',
            'role' => 'required|exists:roles,id', // validating rol
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'organisation_id' => $data['organisation'],
        ]);

        $user->roles()->attach($data['role']);
        return $user;
    }

    public function showRegistrationForm()
    {
        $roles = Role::orderBy('name')->pluck('name', 'id');
        $organisations = Organisation::get();

        return view('auth.register', compact('roles','organisations'));
    }
}
