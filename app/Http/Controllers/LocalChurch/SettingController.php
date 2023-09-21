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

}
