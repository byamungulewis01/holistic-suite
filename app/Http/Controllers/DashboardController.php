<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // __construct
    public function __construct()
    {
        $this->middleware('auth');
    }
    //headquarter
    public function headquarter()
    {
        return view('dashboard.headquarter');
    }
    //region
    public function region()
    {
        return view('dashboard.region');
    }
    //parish
    public function parish()
    {
        return view('dashboard.parish');
    }
    //localChurch
    public function localChurch()
    {
        return view('dashboard.local-church');
    }
    // profile
    public function profile()
    {
        return view('users.profile');
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

        User::findorfail(auth()->user()->id)->update([
            'photo' => $name,
        ]);
        return redirect()->back()->with('success', 'Profile picture changed successfully');
    }
    // changePassword
    public function changePassword(Request $request)
    {
        $formField = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
        $user = User::findorfail(auth()->user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->update(['password' => Hash::make($request->password)]);
            auth()->logout();
            return back()->with('success', 'Password Changed Successfully');
        } else {
            return back()->with('error', 'Old Password Not Matched');
        }
    }
    // changePersonalDetails
    public function changePersonalDetails(Request $request)
    {
        $formField = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . auth()->user()->id,
            'phone' => 'required|unique:users,phone,' . auth()->user()->id,
            'username' => 'required|unique:users,username,' . auth()->user()->id,
        ]);
        User::findorfail(auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        return redirect()->back()->with('success', 'Personal Details Changed Successfully');
    }
    public function changeDefaultPassword()
    {
        return view('auth.change-password');
    }
}
