<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Office;
use App\Models\Recommand\AssemblyProof;
use App\Models\Recommand\MemberProof;
use App\Models\Recommandation;
use App\Models\Recommand\TransferRequest;
use Illuminate\Http\Request;

class RecommandationController extends Controller
{
    //moving
    public function moving()
    {
        $regions = Office::where('type', 'region')->get();
        $movings = Recommandation::where('member_id', auth()->guard('member')->user()->member_id)->get();
        return view('frontend.recommandation.moving', compact('regions', 'movings'));
    }

    // storeMoving
    public function storeMoving(Request $request)
    {
        $request->validate([
            'region' => 'required',
            'parish' => 'required',
            'local_church' => 'required',
            'reason' => 'nullable',
        ]);
        $request->merge([
            'member_id' => auth()->guard('member')->user()->member_id,
            'from' => auth()->guard('member')->user()->member->local_church_id,
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
        ]);

        $check = Recommandation::where('member_id', auth()->guard('member')->user()->member_id)->where('status', 1)->first();
        if ($check) {
            return back()->with('error', 'You have already applied for moving');
        }

        Recommandation::create($request->all());
        return back()->with('success', 'Recommandation Applied successfully');
    }

    // updateMoving
    public function updateMoving(Request $request, $id)
    {
        $request->validate([
            'region' => 'required',
            'parish' => 'required',
            'local_church' => 'required',
            'reason' => 'nullable',
        ]);
        $request->merge([
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
        ]);
        Recommandation::where('id', $id)->first()->update($request->except('_token', '_method'));
        return back()->with('success', 'Modified successfully');
    }
    // destroyMoving
    public function destroyMoving($id)
    {
        Recommandation::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }

    // transfer
    public function transfer()
    {
        $regions = Office::where('type', 'region')->get();
        return view('frontend.recommandation.transfer', compact('regions'));
    }
    public function transferList()
    {
        $transfer = TransferRequest::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.recommandation.transferList', compact('transfer'));
    }
    public function storeTransfer(Request $request)
    {
        $request->validate([
            'region' => 'required',
            'parish' => 'required',
            'local_church' => 'required',
            'reason' => 'nullable',
        ]);
        if ($request->requestedBy == 2) {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
        }
        $member = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member_id : Member::where('reg_no', $request->reg_number)->first()->id;
        $request->merge([
            'from' => auth()->guard('member')->user()->member->local_church_id,
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
            'applyBy' => auth()->guard('member')->user()->id,
            'member_id' => $member,
        ]);

        $check = TransferRequest::where('member_id', $member)->where('status', 1)->first();
        if ($check) {
            return back()->with('error', 'You have already applied for Transfer');
        }

        TransferRequest::create($request->all());
        return to_route('member.recommandation.transferList')->with('success', 'Transfer Applied successfully');
    }

    public function destroyTransfer($id)
    {
        TransferRequest::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }
    public function assemblyProof()
    {
        $regions = Office::where('type', 'region')->get();
        return view('frontend.recommandation.assemblyProof', compact('regions'));
    }
    public function assemblyProofList()
    {
        $collections = AssemblyProof::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.recommandation.assemblyProofList', compact('collections'));
    }
    public function storeAssemblyProof(Request $request)
    {
        $request->validate([
            'region' => 'required',
            'parish' => 'required',
            'local_church' => 'required',
        ]);
        if ($request->requestedBy == 2) {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
        }
        $member = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member_id : Member::where('reg_no', $request->reg_number)->first()->id;
        $request->merge([
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
            'applyBy' => auth()->guard('member')->user()->id,
            'member_id' => $member,
        ]);

        $check = AssemblyProof::where('member_id', $member)->where('status', 1)->first();
        if ($check) {
            return back()->with('error', 'You have already made Application');
        }

        AssemblyProof::create($request->all());
        return to_route('member.recommandation.assemblyProofList')->with('success', 'Application Submited successfully');
    }
    public function memberProof()
    {
        $regions = Office::where('type', 'region')->get();
        return view('frontend.recommandation.memberProof', compact('regions'));
    }
    public function memberProofList()
    {
        $collections = MemberProof::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.recommandation.memberProofList', compact('collections'));
    }
    public function storeMemberProof(Request $request)
    {
        $request->validate([
            'region' => 'required',
            'parish' => 'required',
            'local_church' => 'required',
        ]);
        if ($request->requestedBy == 2) {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
        }
        $member = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member_id : Member::where('reg_no', $request->reg_number)->first()->id;
        $request->merge([
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
            'applyBy' => auth()->guard('member')->user()->id,
            'member_id' => $member,
        ]);

        $check = MemberProof::where('member_id', $member)->where('status', 1)->first();
        if ($check) {
            return back()->with('error', 'You have already made Application');
        }

        MemberProof::create($request->all());
        return to_route('member.recommandation.memberProofList')->with('success', 'Application Submited successfully');
    }

}
