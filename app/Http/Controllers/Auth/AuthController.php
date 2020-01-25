<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

	public function register()
    {
    	return view('login_register/register');
	}

	
    public function postRegister(Request $request )
    {
    	User::create([
    		'name'=> $request->nama,
    		'email'=> $request->email,
    		'password'=> bcrypt($request->password)

    	]);
    	   return redirect('/login');
	}


/*    public function login()
    {
        $pengaturan = DB::table('pengaturan')->get();
        $menu = DB::table('menu')->get();

        return view('login_register/login',['pengaturan' => $pengaturan, 'menu'=>$menu]);
    }
*/
/*    public function postLogin(Request $request)
    {
        if(!\Auth::attempt(['email' => $request->email, 'password' => $request->password ])){
            return redirect()->back();
        }

         return redirect('/galangdana/list');
    }*/







public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect('/');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        else{
            $data = User::create([
                'name'     => $user->name,
                'email'    => !empty($user->email)? $user->email : '' ,
                'provider' => $provider,
                'provider_id' => $user->id
            ]);
            return $data;
        }
    }



}

?>