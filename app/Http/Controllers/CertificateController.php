<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Office;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Recommand\MemberProof;
use App\Models\Recommand\AssemblyProof;
use App\Models\Recommand\TransferRequest;

class CertificateController extends Controller
{
    //
    public function transferCert($id)
    {
        $record = TransferRequest::findorfail(decrypt($id));
        $from = Office::where('id',$record->from)->first();
        $parish_from = Office::where('id',$record->parish_from)->first();
        $church = Office::where('id',$record->from)->first()->name;
        $parish = Office::where('reg_number',$from->parish_number)->first()->name;
        $region = Office::where('reg_number',$from->region_number)->first()->name;
        $member = Member::where('id',$record->member_id)->first();
        // dd($member);
        $itorero = Office::where('id',$record->local_church_id)->first()->name;
        $paruwase = Office::where('id',$record->parish_id)->first()->name;
        $ururembo = Office::where('id',$record->region_id)->first()->name;
        // dd($record->from,$record->parish_from);
        $paster = User::where('role','local church')->where('local_church_id',$record->from)->where('post',1)->first();
        $parish_paster = User::where('role','parish')->where('parish_id',$record->parish_from)->where('post',1)->first();

        $pdf = Pdf::loadView('certificate.transfer',
        compact('member', 'from', 'parish_from','church','parish','region','itorero','paruwase','ururembo','record','paster','parish_paster')
        )->setPaper('a4', 'portrait');
         return $pdf->stream($record->document_no.'.pdf');

    }
    public function assemblyProofCert($id)
    {
        $record = AssemblyProof::findorfail(decrypt($id));
        $member = Member::where('id',$record->member_id)->first();
        // dd($member);
        $itorero = Office::where('id',$record->local_church_id)->first();
        $paruwase = Office::where('id',$record->parish_id)->first();
        $ururembo = Office::where('id',$record->region_id)->first();

        $paster = User::where('role','local church')->where('local_church_id',$record->local_church_id)->where('post',1)->first();
        $parish_paster = User::where('role','parish')->where('parish_id',$record->parish_id)->where('post',1)->first();
        $pdf = Pdf::loadView('certificate.assembly',
        compact('member','itorero','paruwase','ururembo','record','paster','parish_paster')
        )->setPaper('a4', 'portrait');
         return $pdf->stream($record->document_no.'.pdf');

    }
    public function memberProofCert($id)
    {
        $record = MemberProof::findorfail(decrypt($id));
        $member = Member::where('id',$record->member_id)->first();
        // dd($member);
        $itorero = Office::where('id',$record->local_church_id)->first();
        $paruwase = Office::where('id',$record->parish_id)->first();
        $ururembo = Office::where('id',$record->region_id)->first();

        $paster = User::where('role','local church')->where('local_church_id',$record->local_church_id)->where('post',1)->first();
        $parish_paster = User::where('role','parish')->where('parish_id',$record->parish_id)->where('post',1)->first();
        $pdf = Pdf::loadView('certificate.memberProof',
        compact('member','itorero','paruwase','ururembo','record','paster','parish_paster')
        )->setPaper('a4', 'portrait');
         return $pdf->stream($record->document_no.'.pdf');

    }
}
