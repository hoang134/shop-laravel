<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    /*
     * @param $email, $password
     * @login
     * @return boolen
     */
    public function login() {

        return view('backend/modules/auth/login');
    }

    public function postLogin(LoginRequest $request)
    {
        $user = $request->except('_token');

        $dataUser = User::where('username', $request->username)->first();

        if(empty($dataUser)) {
            return redirect()->back()->with('danger', __('labels.login.user_exist') );
        }

        if($dataUser->status != Constant::STATUS_ACTIVE) {
            return redirect()->back()->with('danger', __('labels.login.user_lock'));
        }
        if(Auth::attempt($user)) {
            return redirect()->route('home.index');
        } else {
            return redirect()->back()->with('danger', __('labels.login.user_exist'));
        }

    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
