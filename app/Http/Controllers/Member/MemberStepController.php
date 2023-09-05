<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Office;
use App\Models\Services\ChildrenPrays;
use App\Models\Services\FuneralMember;
use App\Models\Services\HolyCommunion;
use App\Models\Services\PrayerRequest;
use App\Models\Services\WeddingProject;
use Illuminate\Http\Request;

class MemberStepController extends Controller
{
    //childrenPrays
    public function childrenPrays()
    {
        return view('frontend.services.childrenPrays');
    }
    public function childrenPraysList()
    {
        $collections = ChildrenPrays::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.services.childrenPraysList', compact('collections'));
    }
    // storeChildrenPrays
    public function storeChildrenPrays(Request $request)
    {
        // validate the data
        $request->validate
            ([
            'name' => 'required|min:5|string',
            'fatherName' => 'required|min:5|string',
            'motherName' => 'required|min:5|string',
            'parentPhone' => 'required|numeric|digits:10',
            'gender' => 'required',
            'dateOfBirth' => 'required',
        ]);
        $request->merge([
            'applyBy' => auth()->guard('member')->user()->id,
            'local_church_id' => auth()->guard('member')->user()->member->local_church_id,
        ]);
        // store in the database
        ChildrenPrays::create($request->all());
        return to_route('member.memberStep.childrenPraysList')->with('success', 'Your request has been sent successfully');
    }
    // destroyChildrenPrays
    public function destroyChildrenPrays($id)
    {
        ChildrenPrays::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }
    // funeral
    public function funeral()
    {
        return view('frontend.services.funeral');
    }
    public function funeralList()
    {
        $collections = FuneralMember::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.services.funeralList', compact('collections'));
    }
    // storeFuneral
    public function storeFuneral(Request $request)
    {
        // validate the data
        $request->validate
            ([
            'reg_number' => 'required|min:9|numeric|exists:members,reg_no',
            'dateOfDeath' => 'required',
            'dateOfFuneral' => 'required',
            'deathCourse' => 'required',
        ]);
        $member = Member::where('reg_no', $request->reg_number)->first();
        $request->merge([
            'member_id' => $member->id,
            'applyBy' => auth()->guard('member')->user()->id,
            'local_church_id' => $member->local_church_id,
        ]);
        $existy = FuneralMember::where('member_id', $member->id)->first();
        if ($existy) {
            return back()->with('warning', 'Member Arleady Registered');
        }
        // store in the database
        FuneralMember::create($request->all());
        return to_route('member.memberStep.funeralList')->with('success', 'Your request has been sent successfully');
    }
    public function destroyFuneral($id)
    {
        FuneralMember::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }
    // holyCommunion
    public function holyCommunion()
    {
        return view('frontend.services.holyCommunion');
    }
    // storeHolyCommunion
    public function storeHolyCommunion(Request $request)
    {
        if ($request->requestedBy == 1) {
            HolyCommunion::create([
                'member_id' => auth()->guard('member')->user()->member_id,
                'service' => 'home',
                'applyBy' => auth()->guard('member')->user()->id,
                'local_church_id' => auth()->guard('member')->user()->member->local_church_id,
            ]);
        } else {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
            HolyCommunion::create([
                'member_id' => Member::where('reg_no', $request->reg_number)->first()->id,
                'service' => 'home',
                'applyBy' => auth()->guard('member')->user()->id,
                'local_church_id' => auth()->guard('member')->user()->member->local_church_id,
            ]);
        }
        return to_route('member.home')->with('success', 'Your request has been sent successfully');
    }
    // prayerRequest
    public function prayerRequest()
    {
        return view('frontend.services.prayerRequest');
    }
    // storePrayerRequest
    public function storePrayerRequest(Request $request)
    {
        $request->validate([
            'service' => 'required',
            'date' => 'required',
            'prayers' => 'required',
        ]);
        $request->merge([
            'applyBy' => auth()->guard('member')->user()->id,
            'local_church_id' => auth()->guard('member')->user()->member->local_church_id,
            'service_type_id' => $request->service,
            'member_id' => ($request->requestedBy == 1) ? auth()->guard('member')->user()->member_id : Member::where('reg_no', $request->reg_number)->first()->id,
        ]);

        if ($request->requestedBy == 2) {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
        }
        // store in the database
        PrayerRequest::create($request->all());
        return to_route('member.home')->with('success', 'Your request has been sent successfully');
    }

    // weddingProject
    public function weddingProject()
    {
        $regions = Office::where('type', 'region')->get();
        return view('frontend.services.weddingProject', compact('regions'));
    }
    public function weddingProjectList()
    {
        $regions = Office::where('type', 'region')->get();
        return view('frontend.services.weddingProject', compact('regions'));
    }
    // storeWeddingProject
    public function storeWeddingProject(Request $request)
    {
        $request->validate([
            'boy_national_id' => 'required',
            'boy_aids_certificate' => 'required',
            'boy_ceribate_certificate' => 'required',
            'girl_national_id' => 'required',
            'girl_aids_certificate' => 'required',
            'girl_ceribate_certificate' => 'required',
            'region' => 'required',
            'parish' => 'required',
            'local_church' => 'required',
            'proposedDate' => 'required',
        ]);
        $request->merge([
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
            'applyBy' => auth()->guard('member')->user()->id,
            'church' => auth()->guard('member')->user()->member->local_church_id,
        ]);
        if ($request->type == 1) {
            $request->validate([
                'boyReg_no' => 'required|exists:members,reg_no',
                'boy_father_name' => 'required',
                'boy_mother_name' => 'required',
                'girlReg_no' => 'required|exists:members,reg_no',
                'girl_father_name' => 'required',
                'girl_mother_name' => 'required',
            ]);

            $request->merge([
                'churchMember' => 'both',
                'boy_member_id' => Member::where('reg_no',$request->boyReg_no)->first()->id,
                'girl_member_id' => Member::where('reg_no',$request->girlReg_no)->first()->id,
            ]);

        } else {
            $request->validate([
                'reg_number' => 'required|exists:members,reg_no',
                'father_name' => 'required',
                'mother_name' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'fatherName' => 'required',
                'motherName' => 'required',
                'religion' => 'required',
                'certificate' => 'required',
            ]);
            if ($request->hasFile('certificate')) {
                $certificate = $request->file('certificate');
                $certName = time() . '.' . $certificate->getClientOriginalExtension();
                $certificate->move(public_path('documents/certificates'), $certName);
            }
            if($request->whoIsMember == 'umuhungu'){

                $request->merge([
                    'churchMember' => 'boy',
                    'boy_member_id' => Member::where('reg_no',$request->reg_number)->first()->id,
                    'boy_father_name' => $request->father_name,
                    'boy_mother_name' => $request->mother_name,
                    'girl_name' => $request->name,
                    'girl_phone' => $request->phone,
                    'girl_father_name' => $request->fatherName,
                    'girl_mother_name' => $request->motherName,
                    'girl_religion' => $request->religion,
                    'girl_religion_certificate' => $certName,
                ]);
            }else {
                $request->merge([
                    'churchMember' => 'girl',
                    'girl_member_id' => Member::where('reg_no',$request->reg_number)->first()->id,
                    'girl_father_name' => $request->father_name,
                    'girl_mother_name' => $request->mother_name,
                    'boy_name' => $request->name,
                    'boy_phone' => $request->phone,
                    'boy_father_name' => $request->fatherName,
                    'boy_mother_name' => $request->motherName,
                    'boy_religion' => $request->religion,
                    'boy_religion_certificate' => $certName,
                ]);
            }
        }
        if ($request->hasFile('boy_national_id')) {
            $certificate = $request->file('boy_national_id');
            $boy_nid = time() . '.' . $certificate->getClientOriginalExtension();
            $certificate->move(public_path('documents/national_ids'), $boy_nid);
        }
        if ($request->hasFile('boy_aids_certificate')) {
            $certificate = $request->file('boy_aids_certificate');
            $boy_aids = time() . '.' . $certificate->getClientOriginalExtension();
            $certificate->move(public_path('documents/aids_certificate'), $boy_aids);
        }
        if ($request->hasFile('boy_ceribate_certificate')) {
            $certificate = $request->file('boy_ceribate_certificate');
            $boy_ceribate = time() . '.' . $certificate->getClientOriginalExtension();
            $certificate->move(public_path('documents/ceribate_certificate'), $boy_ceribate);
        }
        if ($request->hasFile('girl_national_id')) {
            $certificate = $request->file('girl_national_id');
            $girl_nid = time() . '.' . $certificate->getClientOriginalExtension();
            $certificate->move(public_path('documents/national_ids'), $girl_nid);
        }
        if ($request->hasFile('girl_aids_certificate')) {
            $certificate = $request->file('girl_aids_certificate');
            $girl_aids = time() . '.' . $certificate->getClientOriginalExtension();
            $certificate->move(public_path('documents/aids_certificate'), $girl_aids);
        }
        if ($request->hasFile('girl_ceribate_certificate')) {
            $certificate = $request->file('girl_ceribate_certificate');
            $girl_ceribate = time() . '.' . $certificate->getClientOriginalExtension();
            $certificate->move(public_path('documents/ceribate_certificate'), $girl_ceribate);
        }

       WeddingProject::create($request->all(),[
        'boy_national_id' => $boy_nid,
        'boy_aids_certificate' => $boy_aids,
        'boy_ceribate_certificate' =>$boy_ceribate,
        'girl_national_id' => $girl_nid,
        'girl_aids_certificate' => $girl_aids,
        'girl_ceribate_certificate' => $girl_ceribate
       ]);
       return to_route('member.memberStep.weddingProjectList')->with('success', 'Your request has been sent successfully');
    }

}
