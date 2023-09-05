<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MemberAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    //index
    public function index()
    {
        return view('frontend.index');
    }

    // login
    public function login()
    {
        return view('frontend.auth.login');
    }
    public function loginAuth(Request $request)
    {
        $request->validate([
            'reg_no' => 'required',
            'password' => 'required|min:6',
        ]);

    // login on member guard
    $credentials = $request->only('reg_no', 'password');
    if (auth()->guard('member')->attempt($credentials)) {
        //  if not verify
        if (!auth()->guard('member')->user()->verified) {
            return to_route('member.verify',auth()->guard('member')->user()->id);
        }
        return to_route('member.home');
    }
     return redirect()->back()->with('error', 'Invalid Credentials');

    }
    // register
    public function register()
    {
        return view('frontend.auth.register');
    }
    // registerAuth
    public function registerAuth(Request $request)
    {
         $request->validate([
              'reg_no' => 'required|unique:member_accounts,reg_no|exists:members,reg_no',
              'emailOrPhone' => 'required',
              'password' => 'required|min:6',
         ]);

       $member = Member::where('reg_no', $request->reg_no)->first();
       $check = Member::where(function ($query) use ($request) {
        $query->where('email', $request->emailOrPhone);
        $query->orWhere('phone', $request->emailOrPhone);
        })->where('reg_no', $request->reg_no)->first();
            if($check){
               $account = MemberAccount::create([
                    'member_id' => $member->id,
                    'reg_no' => $request->reg_no,
                    'verification_code' => rand(100000, 999999),
                    'password' => bcrypt($request->password),
                ]);
            }else{
                return redirect()->back()->with('error','Email or Phone Number is not correct');
            }
            // Check if the input is an email
            // if (filter_var($request->emailOrPhone, FILTER_VALIDATE_EMAIL)) {
            //     Mail::send('emails.accountVerify', ['member' => $member, 'verification_code' => $account->verification_code], function ($message) use ($request) {
            //         $message->to($request->emailOrPhone);
            //         $message->subject('Account Verification');
            //     });
            // } else {
            //     // Send SMS
            // }

            return to_route('member.verify',$account->id);
        }
        public function verify($id)
        {
            return view('frontend.auth.verify',compact('id'));
        }
        public function verifyAuth(Request $request,$id)
        {
            $request->validate([
                'code' => 'required',
           ]);
            $account = MemberAccount::where('id',$id)->where('verification_code',$request->code)->first();
            if ($account) {
                $account->update(['verified' => true]);
                return to_route('member.login')->with('success', 'Accout Created Succesufully');
            } else {
                return redirect()->back()->with('error','Verification Code is Incorrect');
            }

        }
        // forgotPassword
        public function forgotPassword()
        {
            return view('frontend.auth.forgotPassword');
            
        }
        public function success()
        {
            return view('frontend.auth.success');
        }
        // forgotPasswordAuth
        public function forgotPasswordAuth(Request $request)
        {
            $request->validate(['emailOrPhone' => 'required']);
            $existy = Member::where('email', $request->emailOrPhone)->orWhere('phone', $request->emailOrPhone)->first();
            if ($existy) {
                $newPassword = Str::random(8);
                MemberAccount::where('member_id',$existy->id)->first()->update(['verified' => true,
                'password' => bcrypt($newPassword)]);
              // Check if the input is an email
                if (filter_var($request->emailOrPhone, FILTER_VALIDATE_EMAIL)) {
                    $via = 'Email';
                    Mail::send('emails.passwordReset', ['user' => $existy , 'password' => $newPassword], function ($message) use ($request) {
                        $message->to($request->emailOrPhone);
                        $message->subject('Password Reset');
                    });
                  return to_route('member.success');
                } else {
                    $via = 'SMS';
                    // Send SMS
                }
                return redirect()->back()->with('success', 'Password reset successfully, check your '.$via.' for new password');
            }
            return redirect()->back()->with('error', 'User not found');
        }

    }
