<?php

namespace App\Http\Controllers\LocalChurch;

use App\Models\Calling;
use App\Models\ClassStep;
use App\Models\ClassMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Services\ChildrenPrays;
use App\Models\Services\FuneralMember;
use App\Models\Services\HolyCommunion;
use App\Models\Services\PrayerRequest;
use App\Models\Services\WeddingProject;

class MemberStepController extends Controller
{

    // childrenPraysList
    public function childrenPraysList()
    {
        $collections = ChildrenPrays::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.services.childrenPraysList', compact('collections'));
    }
    // childrenPraysApprove
    public function childrenPraysApprove(Request $request, $id)
    {
        $record = ChildrenPrays::findorfail($id);
        $record->update([
            'status' => 2, 'aproovedDate' => now(),
            'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
        ]);
        return back()->with('success', 'Approved successfully');
    }
    // childrenPraysReject
    public function childrenPraysReject(Request $request, $id)
    {
        $record = ChildrenPrays::findorfail($id);
        $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
        return back()->with('success', 'Rejected successfully');
    }

    public function funeralList()
    {
        $collections = FuneralMember::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.services.funeralList', compact('collections'));
    }
    // funeralApprove
    public function funeralApprove(Request $request, $id)
    {
        $record = FuneralMember::findorfail($id);
        $record->update([
            'status' => 2, 'aproovedDate' => now(),
            'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
        ]);
        return back()->with('success', 'Approved successfully');
    }
    // funeralReject
    public function funeralReject(Request $request, $id)
    {
        $record = FuneralMember::findorfail($id);
        $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
        return back()->with('success', 'Rejected successfully');
    }

    public function holyCommunionList()
    {
        $collections = HolyCommunion::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.services.holyCommunionList', compact('collections'));
    }
    // holyCommunionApprove
    public function holyCommunionApprove(Request $request, $id)
    {
        $record = HolyCommunion::findorfail($id);
        $record->update([
            'status' => 2, 'aproovedDate' => now(),
            'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
        ]);
        return back()->with('success', 'Approved successfully');
    }
    // holyCommunionReject
    public function holyCommunionReject(Request $request, $id)
    {
        $record = HolyCommunion::findorfail($id);
        $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
        return back()->with('success', 'Rejected successfully');
    }

    public function prayerRequestList()
    {
        $collections = PrayerRequest::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.services.prayerRequestList', compact('collections'));
    }
    // prayerRequestApprove
    public function prayerRequestApprove(Request $request, $id)
    {
        $record = PrayerRequest::findorfail($id);
        $record->update([
            'status' => 2, 'aproovedDate' => now(),
            'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
        ]);
        return back()->with('success', 'Approved successfully');
    }
    // prayerRequestReject
    public function prayerRequestReject(Request $request, $id)
    {
        $record = PrayerRequest::findorfail($id);
        $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
        return back()->with('success', 'Rejected successfully');
    }

    public function weddingProjectList()
    {
        $collections = WeddingProject::where('church', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        $teachers = Calling::where('local_church_id', auth()->user()->local_church_id)->where('type', 'calling')->where('status', 1)->get();
        return view('online-service.services.weddingProjectList', compact('collections', 'teachers'));
    }
    // weddingProjectApprove
    public function weddingProjectApprove(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'teacher_id' => 'required',
            'period' => 'required',
        ]);
        $record = WeddingProject::findorfail($id);
        $record->update([
            'status' => 2, 'aproovedDate' => now(),
            'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
        ]);

        $request->merge([
            'step_id' => 2,
            'region_id' => auth()->user()->region_id,
            'parish_id' => auth()->user()->parish_id,
            'local_church_id' => auth()->user()->local_church_id,
            'user_id' => auth()->user()->id,
        ]);
        $step = ClassStep::create($request->all());
        ClassMember::create(['class_id' => $step->id,'wedding_project_id' => $id,'type' => 'mariage']);

        return back()->with('success', 'Approved successfully');
    }
    // weddingProjectReject
    public function weddingProjectReject(Request $request, $id)
    {
        $record = ChildrenPrays::findorfail($id);
        $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
        return back()->with('success', 'Rejected successfully');
    }

}
