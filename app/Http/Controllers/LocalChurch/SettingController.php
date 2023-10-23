<?php

namespace App\Http\Controllers\LocalChurch;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.localChurch');
    }
    // setWeddingPrice
    public function setWeddingPrice(Request $request)
    {
        $office = Office::where('id',auth()->user()->local_church_id)->first();
        $office->update(['wedding_price' => $request->amount]);
        return back()->with('success', 'Price Changed successfully');
    }
    public function setPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:10'
        ]);
        $office = Office::where('id',auth()->user()->local_church_id)->first();
        $office->update(['phone' => $request->phone]);
        return back()->with('success', 'Phone Changed successfully');
    }
    public function setEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:offices,email,'.auth()->user()->local_church_id
        ]);
        $office = Office::where('id',auth()->user()->local_church_id)->first();
        $office->update(['email' => $request->email]);
        return back()->with('success', 'Email Changed successfully');
    }

}
