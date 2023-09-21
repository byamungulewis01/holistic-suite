<?php

namespace App\Http\Controllers\LocalChurch;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index()
    {
        $members = Discipline::where('local_church_id', auth()->user()->local_church_id)->where('type','member')->where('status',1)->orderBy('created_at','desc')->get();
        return view('discipline.index', compact('members'));
    }
    // store
    public function store(Request $request)
    {
         $request->validate([
             'member_id' => 'required',
             'reason' => 'required',
             'description' => 'nullable',
            ]);

            $request->merge([
             'type' => 'member',
             'region_id' => auth()->user()->region_id,
             'parish_id' => auth()->user()->parish_id,
             'local_church_id' => auth()->user()->local_church_id,
             'user_id' => auth()->user()->id,
            ]);
            Discipline::create($request->all());
            return redirect()->route('localChurch.discipline.index')->with('success', 'Member Assigned successfully');
        }
        public function remove($id)
        {
            Discipline::where('id',$id)->first()->update(['status' => 2]);
            return redirect()->route('localChurch.discipline.index')->with('success', 'Member Removed successfully');
        }
        public function calling()
        {
            $members = Discipline::where('local_church_id', auth()->user()->local_church_id)->where('type','calling')->where('status',1)->orderBy('created_at','desc')->get();
            return view('discipline.calling', compact('members'));
        }

}
