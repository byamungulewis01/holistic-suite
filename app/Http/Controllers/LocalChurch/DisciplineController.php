<?php

namespace App\Http\Controllers\LocalChurch;

use App\Http\Controllers\Controller;
use App\Models\Calling;
use App\Models\Discipline;
use App\Models\Member;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index()
    {
        $members = Discipline::where('local_church_id', auth()->user()->local_church_id)->where('type', 'member')->where('status', 1)->orderBy('created_at', 'desc')->get();
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
        Member::where('id', $request->member_id)->update(['status' => 3]);
        return redirect()->route('localChurch.discipline.index')->with('success', 'Member Assigned successfully');
    }
    public function remove($id)
    {
        Discipline::where('id', $id)->first()->update(['status' => 2, 'expireDate' => now()->format('d/m/Y')]);
        $member_id = Discipline::where('id', $id)->first()->member_id;
        Member::where('id', $member_id)->update(['status' => 1]);
        return redirect()->route('localChurch.discipline.index')->with('success', 'Member Removed successfully');
    }
    public function calling()
    {
        $members = Discipline::where('local_church_id', auth()->user()->local_church_id)->where('type', 'calling')->where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('discipline.calling', compact('members'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $members = Calling::join('members', 'members.id', '=', 'callings.member_id')->where(function ($query) use ($searchTerm) {
            $query->where('members.name', 'LIKE', "%$searchTerm%");
            $query->orWhere('members.reg_no', 'LIKE', "%$searchTerm%");
        })->where('members.status', 1)->where('members.local_church_id', auth()->user()->local_church_id)->where('callings.type', 'calling')
            ->select('members.name as name', 'members.reg_no as reg_no', 'members.email as email', 'members.id as id', 'callings.category_id as category')->get();
        return response()->json($members);
    }

    // storeCalling
    public function storeCalling(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'category_id' => 'required',
            'expireDate' => 'required',
            'reason' => 'required',
            'description' => 'nullable',
        ]);

        $request->merge([
            'type' => 'calling',
            'region_id' => auth()->user()->region_id,
            'parish_id' => auth()->user()->parish_id,
            'local_church_id' => auth()->user()->local_church_id,
            'user_id' => auth()->user()->id,
        ]);
        Discipline::create($request->all());
        Member::where('id', $request->member_id)->update(['status' => 3]);
        Calling::where('member_id', $request->member_id)->update(['status' => 2]);
        return redirect()->route('localChurch.discipline.calling')->with('success', 'Submited successfully');
    }
}
