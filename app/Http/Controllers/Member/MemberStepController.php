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
        if ($member->status != 1) {
            return back()->with('warning', 'Unless Active Member Other can\'t Apply any service');
        }
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
    public function holyCommunionList()
    {
        $collections = HolyCommunion::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.services.holyCommunionList', compact('collections'));
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
            if (Member::where('reg_no', $request->reg_number)->first()->status != 1) {
                return back()->with('warning', 'Unless Active Member Other can\'t Apply any service');
            }

            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
            HolyCommunion::create([
                'member_id' => Member::where('reg_no', $request->reg_number)->first()->id,
                'service' => 'home',
                'applyBy' => auth()->guard('member')->user()->id,
                'local_church_id' => auth()->guard('member')->user()->member->local_church_id,
            ]);
        }
        return to_route('member.memberStep.holyCommunionList')->with('success', 'Your request has been sent successfully');
    }
    // destroyHolyCommunion
    public function destroyHolyCommunion($id)
    {
        HolyCommunion::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }
    // prayerRequest
    public function prayerRequest()
    {
        return view('frontend.services.prayerRequest');
    }
    public function prayerRequestList()
    {
        $collections = PrayerRequest::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.services.prayerRequestList', compact('collections'));
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
//  destroyPrayerRequest
    public function destroyPrayerRequest($id)
    {
        PrayerRequest::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }
    // weddingProject
    public function weddingProject()
    {
        $regions = Office::where('type', 'region')->get();
        return view('frontend.services.weddingProject', compact('regions'));
    }
    public function weddingProjectList()
    {
        $collections = WeddingProject::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        $regions = Office::where('type', 'region')->get();
        return view('frontend.services.weddingProjectList', compact('regions', 'collections'));
    }
    // storeWeddingProject
    public function storeWeddingProject(Request $request)
    {
        $request->validate([
            'boy_certificate1' => 'required|mimes:png,jpg,pdf|max:2048',
            'boy_certificate2' => 'required|mimes:png,jpg,pdf|max:2048',
            'boy_certificate3' => 'required|mimes:png,jpg,pdf|max:2048',
            'girl_certificate1' => 'required|mimes:png,jpg,pdf|max:2048',
            'girl_certificate2' => 'required|mimes:png,jpg,pdf|max:2048',
            'girl_certificate3' => 'required|mimes:png,jpg,pdf|max:2048',
            'region' => 'required',
            'parish' => 'required',
            'local_church' => 'required',
            'proposedDate' => 'required',
        ]);
        if ($request->hasFile('boy_certificate1')) {
            $certificate1 = $request->file('boy_certificate1');
            $boy_nid = time() . '.' . $certificate1->getClientOriginalExtension();
            $certificate1->move(public_path('documents/national_ids'), $boy_nid);
        }
        if ($request->hasFile('boy_certificate2')) {
            $certificate2 = $request->file('boy_certificate2');
            $boy_aids = time() . '.' . $certificate2->getClientOriginalExtension();
            $certificate2->move(public_path('documents/aids_certificate'), $boy_aids);
        }
        if ($request->hasFile('boy_certificate3')) {
            $certificate3 = $request->file('boy_certificate3');
            $boy_ceribate = time() . '.' . $certificate3->getClientOriginalExtension();
            $certificate3->move(public_path('documents/ceribate_certificate'), $boy_ceribate);
        }
        if ($request->hasFile('girl_certificate1')) {
            $certificate4 = $request->file('girl_certificate1');
            $girl_nid = time() . '.' . $certificate4->getClientOriginalExtension();
            $certificate4->move(public_path('documents/national_ids'), $girl_nid);
        }
        if ($request->hasFile('girl_certificate2')) {
            $certificate5 = $request->file('girl_certificate2');
            $girl_aids = time() . '.' . $certificate5->getClientOriginalExtension();
            $certificate5->move(public_path('documents/aids_certificate'), $girl_aids);
        }
        if ($request->hasFile('girl_certificate3')) {
            $certificate6 = $request->file('girl_certificate3');
            $girl_ceribate = time() . '.' . $certificate6->getClientOriginalExtension();
            $certificate6->move(public_path('documents/ceribate_certificate'), $girl_ceribate);
        }
        $request->merge([
            'boy_national_id' => $boy_nid,
            'boy_aids_certificate' => $boy_aids,
            'boy_ceribate_certificate' => $boy_ceribate,
            'girl_national_id' => $girl_nid,
            'girl_aids_certificate' => $girl_aids,
            'girl_ceribate_certificate' => $girl_ceribate,
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

            $boy_status = Member::where('reg_no', $request->boyReg_no)->first()->status;
            $girl_status = Member::where('reg_no', $request->girlReg_no)->first()->status;
            if ($boy_status != 1 && $girl_status != 1) {
                return back()->with('error', 'Unless Active Member will be registered');
            }

            $request->merge([
                'churchMember' => 'both',
                'boy_member_id' => Member::where('reg_no', $request->boyReg_no)->first()->id,
                'girl_member_id' => Member::where('reg_no', $request->girlReg_no)->first()->id,
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
                'certificate' => 'required|mimes:png,jpg,pdf|max:2048',
            ]);

            if ($request->hasFile('certificate')) {
                $certificate = $request->file('certificate');
                $certName = time() . '.' . $certificate->getClientOriginalExtension();
                $certificate->move(public_path('documents/certificates'), $certName);
            }
            $member_status = Member::where('reg_no', $request->reg_number)->first()->status;
            if ($member_status != 1) {
                return back()->with('error', 'Unless Active Member will be registered');
            }
            if ($request->whoIsMember == 'umusore') {
                $request->merge([
                    'churchMember' => 'boy',
                    'boy_member_id' => Member::where('reg_no', $request->reg_number)->first()->id,
                    'boy_father_name' => $request->father_name,
                    'boy_mother_name' => $request->mother_name,
                    'girl_name' => $request->name,
                    'girl_phone' => $request->phone,
                    'girl_father_name' => $request->fatherName,
                    'girl_mother_name' => $request->motherName,
                    'girl_religion' => $request->religion,
                    'girl_religion_certificate' => $certName,
                ]);
            } else {
                $request->merge([
                    'churchMember' => 'girl',
                    'girl_member_id' => Member::where('reg_no', $request->reg_number)->first()->id,
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

        WeddingProject::create($request->all());
        return to_route('member.memberStep.weddingProjectList')->with('success', 'Your request has been sent successfully');
    }
    public function destroyWeddingProject($id)
    {
        WeddingProject::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }

}
