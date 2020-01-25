<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Events\MyEvent;

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
    protected $redirectTo = '/';
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {

    $pengaturan = DB::table('pengaturan')->get();
    $menu = DB::table('menu')->get();
        
        return view('login_register/login',['pengaturan' => $pengaturan, 'menu'=>$menu]);
    }




    public function login(Request $request)
    {

        $notification_gagal = array(
            'message' => 'Login Gagal',
            'alert-type' => 'error'
        );

         $notification_berhasil = array(
            'message' => 'Login berhasil',
            'alert-type' => 'success'
        );

        if(!\Auth::attempt(['email' => $request->email, 'password' => $request->password ])){
            return redirect()->back()->with($notification_gagal);

        }else {
            if(\Auth::user()->role=="user"){
                return redirect('/campaign')->with($notification_berhasil);
                //return redirect()->intended('defaultpage');
            }else{
                return redirect('/dashboard_admin')->with($notification_berhasil);
            }
            
        }
    
    }



}
