<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating admin for the application and
    | redirecting them to your admin home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    private $type = "admin";

    public function __construct()
    {
        $this->middleware('admin.guest')->except(['account-restricted', 'logout', 'dashboard', 'noteChange']);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    // Dashboard
    public function index()
    {
        $type = $this->type;
        $page_title = ucwords($type);
        $page_description = 'Login ' . $type . ' dashboard';
        $logo = "images/logo.png";
        $logoText = "images/logo-text.png";

        return view('admin.auth.login', compact('page_title', 'page_description', 'type', 'logo', 'logoText'));
    }

    // Login
    public function login(Request $request)
    {
        $type = $this->type;
        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->active ? 1 : 0)) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->withError('You Are Not Authroised')->onlyInput('email');
        }

        return back()->withError('The provided credentials do not match our records.')->onlyInput('email');
    }

    //forgotPassword
    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);

            $token = Str::random(64);
            DB::table('admin_password_resets')->insert([
                'email' => $request->email,
                'token' => $token
            ]);

            Notification::route('mail', $request->email)->notify(new PasswordReset($token));

            return redirect()->route('admin.login')->withSuccess('Check Your Email To Reset Password !!');
        }

        $page_title = 'Page Forgot Password';
        $page_description = 'Page Forgot Password';
        $action = __FUNCTION__;
        return view('admin.auth.forgot_password', compact('page_title', 'page_description', 'action'));
    }

    //Show Reset Password
    public function showResetPassword(string $token)
    {
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    //Submit Reset Password
    public function submitResetPassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email|exists:users',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('admin_password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withError('Invalid token!');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        if ($user) {
            DB::table('admin_password_resets')->where(['email' => $request->email])->delete();
            return redirect()->route('admin.login')->withSuccess('Password Reset Successfully !!');
        }
        return redirect()->route('admin.forgot-password')->withError('Token Expired Please Try Again.');
    }

    //accountRestricted
    public function accountRestricted()
    {
        $page_title = 'Account Restricted';
        $page_description = 'Account Restricted';
        return view('admin.auth.account-restricted', compact('page_title', 'page_description'));
    }


    //Change Password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'          => 'required',
            'password'                  => 'required|string|min:8|confirmed',
            'password_confirmation'     => 'required'
        ]);

        if (Hash::check(Auth::user()->password, $request->current_password)) {
            $user = User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->password)]);
            if ($user) {
                return redirect()->back()->withSuccess('Password Reset Successfully !!');
            }
        }
        return redirect()->back()->withError('Current Password Not Matched !!');
    }

    //Mote Change
    public function noteChange(Request $request)
    {
        $request->validate([
            'title'          => 'required',
        ]);

        $user = User::where('id', Auth::user()->id)->update(['title' => $request->title]);
        if ($user) {
            return redirect()->back()->withSuccess('Note Added Successfully !!');
        }
        return redirect()->back()->withError('Note Not Matched !!');
    }

    //logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }


    //Dashboard
    public function dashboard()
    {
        $data['page_title'] = 'Admin - Dashboard';
        $data['page_description'] = 'Admin - Dashboard';
        return view('admin.dashboard', $data);
    }
}
