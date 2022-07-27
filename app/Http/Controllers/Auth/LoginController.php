<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use DB;
use App\User; 
// OR
// use App\Models\User;  
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }


    protected function validateLogin(Request $request)
    {
        $rowTotalObj = DB::table('users')
        ->select(DB::raw('count(*) as rcount'))
        ->Where('email','=', $request['email'])
        ->Where('activestatus','=', 'Active')
        ->get();

        $totalData = $rowTotalObj[0]->rcount;

        if($totalData == 0){
            throw ValidationException::withMessages([$this->username() => __('The account is inactive')]);
        }
    }

/*
    public function login(Request $request) {

        $rowTotalObj = DB::table('users')
        ->select(DB::raw('count(*) as rcount'))
        ->Where('email','=', $request['email'])
        ->Where('activestatus','=', 'Active')
        ->get();

        $totalData = $rowTotalObj[0]->rcount;

        if($totalData == 0){
           return redirect('/');
  
    }
*/

    public function logout(Request $request) {
      Auth::logout();
      return redirect('/');
    }
}
