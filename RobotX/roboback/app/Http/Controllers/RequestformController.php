<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RequestformController extends Controller
{


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/requestform';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
            'phonenumber' => 'required|min:8',
            'email' => 'required|email|max:255|unique:users',
            'company' => 'required|max:255',
            'address' => 'required|max:255',
            'postalcode' => 'required|max:255',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     
    protected function create(Request $request)
    {
        $data = Input::all();

        \App\Request::create([
            'name' => $data['name'],
            'phonenumber' => $data['phonenumber'],
            'email' => $data['email'],
            'company' => $data['company'],
            'address' => $data['address'],
            'postalcode' => $data['postalcode'],

        ]);
        return redirect('/home');
    }

    public function index()
    {

            $request= DB::table('requests')->get();

            return view('requestoverview', compact('request'));
    }
    */
    protected function create(Request $request)
    {
        $data = Input::all();

        \App\Request::create([
            'name' => $data['name'],
            'phonenumber' => $data['phonenumber'],
            'email' => $data['email'],
            'company' => $data['company'],
            'address' => $data['address'],
            'postalcode' => $data['postalcode'],

        ]);

        $email=$data['email'];

        $content = [
          'name' => $data['name'],
          'phonenumber' => $data['phonenumber'],
          'email' => $data['email'],
          'company' => $data['company'],
          'address' => $data['address'],
          'postalcode' => $data['postalcode'],
        ];
        Mail::send('auth.verify', $content, function ($message) use ($email){
            //Define the email body
        $message->to($email)->subject('Bevestig van uw account aanvraag');
            });

      // check if email is send:
      if (count(Mail::failures()) > 0){
        //Define an error flashSession:
        echo('Email is niet verstuurd');
      } else {
        echo('Email is verstuurd');
      }
        return redirect('/home');
    }

    public function index()
    {

            $request= DB::table('requests')->get();

            return view('requestoverview', compact('request'));
    }

    public function destroy(Request $request, $id)
    {
        try {
            $data = App\Request::where('id', $id)->firstOrFail();
            $data->delete();
        } catch (\Exception $e) {
            $request->session()->flash('status', 'Error!');
        }
    }


}
