<?php

namespace App\Http\Controllers\LocalChurch;

use App\Models\Friend;
use App\Models\Member;
use App\Models\Calling;
use App\Models\Penitent;
use App\Models\Teenager;
use App\Models\ClassStep;
use App\Models\ClassMember;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use App\Http\Controllers\Controller;

class ClassStepController extends Controller
{
    //index
    public function index()
    {
        $teachers = Calling::where('local_church_id', auth()->user()->local_church_id)->where('type','calling')->where('status', 1)->get();
        $steps = ClassStep::where('local_church_id', auth()->user()->local_church_id)->get();
        return view('steps.index', compact('teachers', 'steps'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'teacher_id' => 'required',
            'step_id' => 'required',
            'period' => 'required',
        ]);
        $request->merge([
                'region_id' => auth()->user()->region_id,
                'parish_id' => auth()->user()->parish_id,
                'local_church_id' => auth()->user()->local_church_id,
                'user_id' => auth()->user()->id,
        ]);
        ClassStep::create($request->all());
        return redirect()->route('localChurch.step.index')->with('success', 'Class Step Created successfully');
    }
    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'teacher_id' => 'required',
            'step_id' => 'required',
            'period' => 'required',
        ]);
        ClassStep::where('id', $id)->update($request->except('_token', '_method'));
        return redirect()->route('localChurch.step.index')->with('success', 'Class Step Updated successfully');
    }
    // destroy
    public function destroy($id)
    {
        ClassStep::where('id', $id)->delete();
        return redirect()->route('localChurch.step.index')->with('success', 'Class Step Deleted successfully');
    }
    public function members($id){
        $class = ClassStep::where('id', $id)->first();
        $members = ClassMember::where('class_id', $id)->orderBy('created_at','desc')->get();
        return view('steps.members', compact('class', 'members'));
    }

    // newBeliever
    public function newBeliever(Request $request, $id)
    {
        $request->validate([
            'member' => 'required',
            'member_type' => 'required',
        ]);

        $request->merge([
            'class_id' => $id,
            'type' => 'baptism',
        ]);
        if ($request->member_type == 'penitent') {
             $request->merge(['penitent_id' => $request->member,'from' => 1]);
             ClassMember::create($request->all());
             Penitent::where('id', $request->member)->first()->update(['status' => 2]);
        } elseif ($request->member_type == 'teenager') {
            $request->merge(['teenager_id' => $request->member,'from' => 2]);
             ClassMember::create($request->all());
            Teenager::where('id', $request->member)->first()->update(['status' => 2]);
        } else {
            $request->merge(['friend_id' => $request->member,'from' => 3]);
             ClassMember::create($request->all());
            Friend::where('id', $request->member)->first()->update(['status' => 2]);
        }

        return redirect()->back()->with('success', 'Member Added successfully');
    }
    // destroyBeliever
    public function destroyBeliever($id)
    {
        $member = ClassMember::where('id', $id)->first();
        if ($member->from == 1) {
            Penitent::where('id', $member->penitent_id)->first()->update(['status' => 1]);
        } elseif ($member->from == 2) {
            Teenager::where('id', $member->teenager_id)->first()->update(['status' => 1]);
        } else {
            Friend::where('id', $member->friend_id)->first()->update(['status' => 1]);
        }
        ClassMember::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Member Deleted successfully');
    }
    // completion
    public function completion($id) {
        ClassMember::where('id',$id)->first()->update(['status' => 3]);
        return redirect()->back()->with('success', 'Member Completed');
    }

    // newMember
    public function newMember(Request $request, $id)
    {
      $exist = ClassMember::where('class_id', $id)->where('member_id', $request->member_id)->first();
        if ($exist) {
            return redirect()->back()->with('error', 'Member Already Exist');
        }
        ClassMember::create(['class_id' => $id,'member_id' => $request->member_id,'type' => 'others']);
        return redirect()->back()->with('success', 'Member Added successfully');
    }
    // destroyMember
    public function destroyMember($id) {
        ClassMember::where('id',$id)->first()->delete();
        return redirect()->back()->with('success', 'Member Deleted successfully');
    }

    public function schedule($id){
        $class = ClassStep::where('id', $id)->first();
        $schedules = ClassSchedule::where('class_id', $id)->orderBy('created_at','desc')->get();
        return view('steps.schedule', compact('class', 'schedules'));
    }
    // scheduleStore
    public function scheduleStore(Request $request, $id)
    {
        $request->validate([
            'topic' => 'required',
            'date' => 'required',
            'description' => 'nullable'
        ]);
        $request->merge(['class_id' => $id,'user_id' => auth()->user()->id]);
        ClassSchedule::create($request->all());
        return redirect()->back()->with('success', 'Class Schedule Created successfully');
    }
    // scheduleUpdate
    public function scheduleUpdate(Request $request, $id)
    {
        $request->validate([
            'topic' => 'required',
            'date' => 'required',
            'description' => 'nullable'
        ]);
        ClassSchedule::where('id', $id)->update($request->except('_token', '_method'));
        return redirect()->back()->with('success', 'Class Schedule Updated successfully');
    }
    // scheduleDestroy
    public function scheduleDestroy($id)
    {
        ClassSchedule::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Class Schedule Deleted successfully');
    }


}
