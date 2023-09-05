<?php

namespace App\Http\Controllers\LocalChurch;

use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\CommissionMember;
use App\Http\Controllers\Controller;

class CommissionController extends Controller
{
    //index
    public function index()
    {
        $commissions = Commission::where('local_church_id', auth()->user()->local_church_id)->get();
        return view('commissions.index', compact('commissions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'commission_id' => 'required',
            'status' => 'required',
        ]);
        $request->merge([
                'code' => 'C'.str_pad(Commission::where('local_church_id', auth()->user()->local_church_id)->count()+1, 3, '0', STR_PAD_LEFT),
                'region_id' => auth()->user()->region_id,
                'parish_id' => auth()->user()->parish_id,
                'local_church_id' => auth()->user()->local_church_id,
                'user_id' => auth()->user()->id,
        ]);
        Commission::create($request->all());
        return redirect()->route('localChurch.commission.index')->with('success', 'Commission Created successfully');
    }
    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'commission_id' => 'required',
            'status' => 'required',
        ]);
        Commission::where('id', $id)->update($request->except('_token', '_method'));
        return redirect()->route('localChurch.commission.index')->with('success', 'Commission Updated successfully');
    }
    // destroy
    public function destroy($id)
    {
        Commission::where('id', $id)->delete();
        return redirect()->route('localChurch.commission.index')->with('success', 'Commission Deleted successfully');
    }

    public function members($id)
    {
        $commission = Commission::where('id',$id)->first();
        $members = CommissionMember::where('commission_id',$id)->get();
        return view('commissions.members', compact('members','commission'));
    }
    // StoreMember
    public function storeMember(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required',
            'period' => 'required',
            'post' => 'required',
        ]);
        $exist = CommissionMember::where('commission_id',$id)->where('member_id',$request->member_id)->first();
        $leaders = CommissionMember::where('commission_id',$id)->where('post',$request->post)->first();

        if ($leaders) {
              return redirect()->back()->with('error', 'Post Already Occupied');
        }

        if ($exist) { return redirect()->back()->with('error', 'Member Already Exist'); }
        $request->merge([
            'commission_id' => $id,
            'user_id' => auth()->user()->id,
        ]);

        CommissionMember::create($request->all());
        return redirect()->back()->with('success', 'Member Added successfully');
    }
    // editMember
    public function editMember(Request $request, $id)
    {
        $request->validate([
            'period' => 'required',
            'post' => 'required',
        ]);
        $leaders = CommissionMember::where('commission_id',$request->commission_id)->where('post',$request->post)->first();

        if ($leaders) {
              return redirect()->back()->with('error', 'Post Already Occupied');
        }

        CommissionMember::where('id',$id)->update($request->except('_token', '_method'));
        return redirect()->back()->with('success', 'Member Updated successfully');
    }
    // destroyMember
    public function destroyMember($id)
    {
        CommissionMember::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Member Deleted successfully');
    }
}
