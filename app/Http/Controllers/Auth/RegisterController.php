<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo ='/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nid' => ['required', 'string', 'min:10', 'max:17', 'unique:users'],
            'address' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/', 'confirmed'],
            'phone' => ['required', 'string', 'min:11' ,'max:11', 'unique:users']
        ]);
    }
/*,
            'userrole' => ['required', 'string', 'max:20'],*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $curDateTime = date ( 'Y-m-d H:i:s' );
        return User::create([
            'usercode' => time(),
            'name' => $data['name'],
            'email' => $data['email'],
            'nid' => $data['nid'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'userrole' => 'Customer',
            'activestatus' => 'Active',
            'phone' => $data['phone']
        ]);
    }
}
