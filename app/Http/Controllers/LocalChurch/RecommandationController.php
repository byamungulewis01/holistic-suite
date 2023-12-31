<?php

namespace App\Http\Controllers\LocalChurch;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recommand\MemberProof;
use App\Models\Recommand\AssemblyProof;
use App\Models\Recommand\TransferRequest;

class RecommandationController extends Controller
{
    public function transferList()
    {
        $transfer = TransferRequest::where('from', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.recommandation.transferList', compact('transfer'));
    }
    // transferApprove
    public function transferApprove(Request $request, $id)
    {
        $record = TransferRequest::findorfail($id);
        $record->update([
            'document_no' => 'TC' . Office::where('id', $record->from)->first()->parish_number . str_pad(TransferRequest::where('from',  $record->from)->count(), 3, '0', STR_PAD_LEFT),
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
        $collections = AssemblyProof::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.recommandation.assemblyProofList', compact('collections'));
    }
    // assemblyProofApprove
    public function assemblyProofApprove(Request $request, $id)
    {
        $record = AssemblyProof::findorfail($id);
        $record->update([
            'document_no' => 'AC' . Office::where('id', $record->local_church_id)->first()->parish_number . str_pad(AssemblyProof::where('local_church_id',  $record->local_church_id)->count(), 3, '0', STR_PAD_LEFT),
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
        $collections = MemberProof::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.recommandation.memberProofList', compact('collections'));
    }
    // memberProofAppove
    public function memberProofAppove(Request $request, $id)
    {
        $record = MemberProof::findorfail($id);
        $record->update([
            'document_no' => 'MC' . Office::where('id', $record->local_church_id)->first()->parish_number . str_pad(MemberProof::where('local_church_id',  $record->local_church_id)->count(), 3, '0', STR_PAD_LEFT),
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
