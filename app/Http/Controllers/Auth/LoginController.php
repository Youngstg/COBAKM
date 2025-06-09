<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected function redirectTo()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->id_role == 888) {
                return RouteServiceProvider::CMS;
            } elseif ($user->id_role == 1111) {
                return RouteServiceProvider::EKRAF;
            } elseif ($user->id_role == 1000) {
                return RouteServiceProvider::PENRISTEK;
            }
        }

        return RouteServiceProvider::HOME;
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/'); // Redirect ke halaman yang diinginkan setelah logout
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware(['auth.session', 'throttle:10,1']);
    }
}
