<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    // __construct
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //index
    public function index()
    {
        return view('auth.login');
    }
    // login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials)) {

            if (auth()->user()->role == 'headquarter') {
                return redirect()->route('headquarter.dashboard');
            } elseif (auth()->user()->role == 'region') {
                return redirect()->route('region.dashboard');
            } elseif (auth()->user()->role == 'parish') {
                return redirect()->route('parish.dashboard');
            } elseif (auth()->user()->role == 'local church') {
                return redirect()->route('localChurch.dashboard');
            }
        }
        return redirect()->back()->with('error', 'Invalid login details');
    }
    // forgotPassword
    public function forgotPassword()
    {
        return view('auth.forget-password');
    }
    // sendResetLinkEmail
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['emailOrPhone' => 'required']);

        $userExisty = User::where('email', $request->emailOrPhone)->orWhere('phone', $request->emailOrPhone)->first();
        if ($userExisty) {
            $newPassword = Str::random(8);
            User::where('id',$userExisty->id)->first()->update(['reset_password_token' => Str::random(10),
            'password' => bcrypt($newPassword)
        ]);
          // Check if the input is an email
            if (filter_var($request->emailOrPhone, FILTER_VALIDATE_EMAIL)) {
                $via = 'Email';
                Mail::send('emails.passwordReset', ['user' => $userExisty , 'password' => $newPassword], function ($message) use ($request) {
                    $message->to($request->emailOrPhone);
                    $message->subject('Password Reset');
                });
              return to_route('success');
            } else {
                $via = 'SMS';
                // Send SMS
            }
            return redirect()->back()->with('success', 'Password reset successfully, check your '.$via.' for new password');
        }
        return redirect()->back()->with('error', 'User not found');
    }
    // success
    public function success()
    {
        return view('auth.success');
    }

}
