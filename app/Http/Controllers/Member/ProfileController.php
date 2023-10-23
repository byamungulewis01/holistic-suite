<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MemberAccount;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('member');
    }
     // profile
     public function profile()
     {
         return view('frontend.profile');
     }
     // changeProfilePicture
     public function changeProfilePicture(Request $request)
     {
         $request->validate([
             'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
         ]);

         if ($request->hasFile('image')) {
             $image = $request->file('image');
             $name = time() . '.' . $image->getClientOriginalExtension();
             $destinationPath = public_path('dist/images/profile');
             $image->move($destinationPath, $name);
         }

         Member::where('id',auth()->guard('member')->user()->member_id)->first()->update([
             'photo' => $name,
         ]);
         return redirect()->back()->with('success', 'Profile picture changed successfully');
     }
     // changePassword
     public function changePassword(Request $request)
     {
         $request->validate([
             'old_password' => 'required',
             'password' => 'required|confirmed|min:8',
         ]);
         $user = MemberAccount::where('member_id',auth()->guard('member')->user()->member_id)->first();
         if (Hash::check($request->old_password, $user->password)) {
             $user->update(['password' => Hash::make($request->password)]);
             auth()->guard('member')->logout();
             return back()->with('success', 'Password Changed Successfully');
         } else {
             return back()->with('error', 'Old Password Not Matched');
         }
     }
     // changePersonalDetails
     public function changePersonalDetails(Request $request)
     {
         $request->validate([
             'name' => 'required',
             'email' => 'required|unique:members,email,' . auth()->guard('member')->user()->member_id,
             'phone' => 'required|unique:members,phone,' . auth()->guard('member')->user()->member_id,
         ]);
         Member::where('id',auth()->guard('member')->user()->member_id)->update([
             'name' => $request->name,
             'email' => $request->email,
             'phone' => $request->phone
         ]);
         return redirect()->back()->with('success', 'Personal Details Changed Successfully');
     }
}
