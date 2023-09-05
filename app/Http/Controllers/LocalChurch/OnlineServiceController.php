<?php

namespace App\Http\Controllers\LocalChurch;

use Illuminate\Http\Request;
use App\Models\Recommandation;
use App\Http\Controllers\Controller;

class OnlineServiceController extends Controller
{
    //moving
    public function moving()
    {
        $applications = Recommandation::where('from', auth()->user()->local_church_id)->get();
        return view('members.onlineService.moving', compact('applications'));
    }
    // aprooveMoving
    public function aprooveMoving($id)
    {
        $application = Recommandation::find($id);
        $application->status = 2;
        $application->aproovedDate = now();
        $application->aproovedBy = auth()->user()->id;
        $application->save();
        return redirect()->back()->with('success', 'Application aprooved successfully');
    }
    // rejectMoving
    public function rejectMoving($id)
    {
        $application = Recommandation::find($id);
        $application->status = 3;
        $application->rejectedDate = now();
        $application->rejectedBy = auth()->user()->id;
        $application->save();
        return redirect()->back()->with('success', 'Application rejected successfully');
    }
}
