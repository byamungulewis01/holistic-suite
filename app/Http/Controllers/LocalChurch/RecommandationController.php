<?php

namespace App\Http\Controllers\LocalChurch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recommand\AssemblyProof;
use App\Models\Recommand\MemberProof;
use App\Models\Recommand\TransferRequest;

class RecommandationController extends Controller
{
    public function transferList()
    {
       $transfer = TransferRequest::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at','desc')->get();
       return view('online-service.recommandation.transferList',compact('transfer'));
    }
    // transferApprove
    public function transferApprove(Request $request, $id)
    {
        $record = TransferRequest::findorfail($id);
        $record->update([
            'status' => 2, 'aproovedDate' => now(),
            'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
        ]);
        return back()->with('success', 'Approved successfully');
    }
    // transferReject
    public function transferReject(Request $request, $id)
    {
        $record = TransferRequest::findorfail($id);
        $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
        return back()->with('success', 'Rejected successfully');
    }

    // assemblyProofList
    public function assemblyProofList()
    {
       $collections = AssemblyProof::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at','desc')->get();
       return view('online-service.recommandation.assemblyProofList',compact('collections'));
    }
    // assemblyProofApprove
    public function assemblyProofApprove(Request $request, $id)
    {
        $record = AssemblyProof::findorfail($id);
        $record->update([
            'status' => 2, 'aproovedDate' => now(),
            'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
        ]);
        return back()->with('success', 'Approved successfully');
    }
    // assemblyProofReject
    public function assemblyProofReject(Request $request, $id)
    {
        $record = AssemblyProof::findorfail($id);
        $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
        return back()->with('success', 'Rejected successfully');
    }
    // memberProofList
    public function memberProofList()
    {
       $collections = MemberProof::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at','desc')->get();
       return view('online-service.recommandation.memberProofList',compact('collections'));
    }
    // memberProofAppove
    public function memberProofAppove(Request $request, $id)
    {
        $record = MemberProof::findorfail($id);
        $record->update([
            'status' => 2, 'aproovedDate' => now(),
            'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
        ]);
        return back()->with('success', 'Approved successfully');
    }
    // memberProofReject
    public function memberProofReject(Request $request, $id)
    {
        $record = MemberProof::findorfail($id);
        $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
        return back()->with('success', 'Rejected successfully');
    }


}
