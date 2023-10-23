<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Office;
use App\Models\Recommand\ChoirMoveRequest;
use App\Models\Recommand\LeaderMeetRequest;
use App\Models\Recommand\PraiseRequest;
use App\Models\Recommand\PreachRequest;
use App\Models\Recommand\SocialMediaPreach;
use App\Models\Recommand\Suggestion;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    //suggestion
    public function suggestion()
    {
        return view('frontend.requests.suggestions');
    }
    public function suggestionList()
    {
        $collections = Suggestion::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.requests.suggestionList', compact('collections'));
    }
    // storeSuggestion
    public function storeSuggestion(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'description' => 'required',
        ]);
        if ($request->requestedBy == 2) {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
        }
        if (Member::where('reg_no', $request->reg_number)->first()->status != 1) {
            return back()->with('warning', 'Unless Active Member Other can\'t Apply any service');
        }
        $member = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member_id : Member::where('reg_no', $request->reg_number)->first()->id;
        $church = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member->local_church_id : Member::where('reg_no', $request->reg_number)->first()->local_church_id;
        $request->merge([
            'local_church_id' => $church,
            'applyBy' => auth()->guard('member')->user()->id,
            'member_id' => $member,
        ]);

        Suggestion::create($request->all());
        return to_route('member.request.suggestionList')->with('success', 'Suggestion successfully Sent');
    }
    // destroySuggestion
    public function destroySuggestion($id)
    {
        Suggestion::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }

    // praiseRequest
    public function praiseRequest()
    {
        return view('frontend.requests.praiseRequest');
    }

    // Praise Request
    public function praiseRequestList()
    {
        $collections = PraiseRequest::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.requests.praiseRequestList', compact('collections'));
    }
    // storePraiseRequest
    public function storePraiseRequest(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'service' => 'required',
        ]);
        if ($request->requestedBy == 2) {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
        }
        if (Member::where('reg_no', $request->reg_number)->first()->status != 1) {
            return back()->with('warning', 'Unless Active Member Other can\'t Apply any service');
        }
        $member = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member_id : Member::where('reg_no', $request->reg_number)->first()->id;
        $church = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member->local_church_id : Member::where('reg_no', $request->reg_number)->first()->local_church_id;
        $request->merge([
            'service_type_id' => $request->service,
            'local_church_id' => $church,
            'applyBy' => auth()->guard('member')->user()->id,
            'member_id' => $member,
        ]);

        PraiseRequest::create($request->all());
        return to_route('member.request.praiseRequestList')->with('success', 'Praise Requested successfully');
    }
    public function destroyPraiseRequest($id)
    {
        PraiseRequest::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }

    public function preachRequest()
    {
        $regions = Office::where('type', 'region')->get();
        return view('frontend.requests.preachRequest', compact('regions'));
    }
    public function preachRequestList()
    {
        $collections = PreachRequest::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.requests.preachRequestList', compact('collections'));
    }

    // storePreachRequestm
    public function storePreachRequest(Request $request)
    {
        $request->validate([
            'places' => 'required',
            'date' => 'required',
        ]);
        if ($request->places == 1) {
            $request->validate([
                'region' => 'required',
                'parish' => 'required',
                'local_church' => 'required',
            ]);
        } elseif ($request->places == 2) {
            $request->validate(['elseWhere' => 'required']);
        } else {
            $request->validate(['abroad' => 'required']);
        }

        if ($request->requestedBy == 2) {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
        }
        if (Member::where('reg_no', $request->reg_number)->first()->status != 1) {
            return back()->with('warning', 'Unless Active Member Other can\'t Apply any service');
        }
        $member = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member_id : Member::where('reg_no', $request->reg_number)->first()->id;
        $church = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member->local_church_id : Member::where('reg_no', $request->reg_number)->first()->local_church_id;
        $request->merge([
            'region_id' => @Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => @Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => @Office::where('reg_number', $request->local_church)->first()->id,
            'applyBy' => auth()->guard('member')->user()->id,
            'church' => $church,
            'member_id' => $member,
        ]);

        PreachRequest::create($request->all());
        return to_route('member.request.preachRequestList')->with('success', 'Preach Requested successfully');
    }
    // destroyPreachRequest
    public function destroyPreachRequest($id)
    {
        PreachRequest::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }

    // socialMediaPreach
    public function socialMediaPreach()
    {
        return view('frontend.requests.socialMediaPreach');
    }

    public function socialMediaPreachList()
    {
        $collections = SocialMediaPreach::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.requests.socialMediaPreachList', compact('collections'));
    }

    // storeSocialMediaPreach
    public function storeSocialMediaPreach(Request $request)
    {
        $request->validate([
            'socialMedia' => 'required|array',
            'motor' => 'required',
        ]);

        if ($request->requestedBy == 2) {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
        }
        if (Member::where('reg_no', $request->reg_number)->first()->status != 1) {
            return back()->with('warning', 'Unless Active Member Other can\'t Apply any service');
        }
        $member = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member_id : Member::where('reg_no', $request->reg_number)->first()->id;
        $church = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member->local_church_id : Member::where('reg_no', $request->reg_number)->first()->local_church_id;

        $socialMedias = [];
        foreach ($request->socialMedia as $item) {
            $socialMedias[] = $item;
        }
        $socialMedia = implode(',', $socialMedias);
        $request->merge([
            'socialMedia' => $socialMedia,
            'applyBy' => auth()->guard('member')->user()->id,
            'church' => $church,
            'member_id' => $member,
        ]);

        SocialMediaPreach::create($request->all());
        return to_route('member.request.socialMediaPreachList')->with('success', 'Preach Requested successfully');
    }
    // destroySocialMediaPreach
    public function destroySocialMediaPreach($id)
    {
        SocialMediaPreach::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }

    public function choirMove()
    {
        $regions = Office::where('type', 'region')->get();
        return view('frontend.requests.choirMove', compact('regions'));
    }
    public function choirMoveList()
    {
        $collections = ChoirMoveRequest::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.requests.choirMoveList', compact('collections'));
    }
    // storeChoirMove
    public function storeChoirMove(Request $request)
    {
        $request->validate([
            'choirName' => 'required',
            'places' => 'required',
            'date' => 'required',
        ]);
        if ($request->places == 1) {
            $request->validate([
                'region' => 'required',
                'parish' => 'required',
                'local_church' => 'required',
            ]);
        } elseif ($request->places == 2) {
            $request->validate(['elseWhere' => 'required']);
        } else {
            $request->validate(['abroad' => 'required']);
        }

        if ($request->requestedBy == 2) {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
        }

        $request->merge([
            'region_id' => @Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => @Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => @Office::where('reg_number', $request->local_church)->first()->id,
            'applyBy' => auth()->guard('member')->user()->id,
            'church' => auth()->guard('member')->user()->member->local_church_id,
            'member_id' => auth()->guard('member')->user()->member_id,
        ]);

        ChoirMoveRequest::create($request->all());
        return to_route('member.request.choirMoveList')->with('success', 'Preach Requested successfully');
    }
    // destroyChoirMove
    public function destroyChoirMove($id)
    {
        ChoirMoveRequest::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }
    public function leaderMeetRequest()
    {
        return view('frontend.requests.leaderMeetRequest');
    }
    public function leaderMeetRequestList()
    {
        $collections = LeaderMeetRequest::where('applyBy', auth()->guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.requests.leaderMeetRequestList', compact('collections'));
    }
    // storeLeaderMeetRequest
    public function storeLeaderMeetRequest(Request $request)
    {
        $request->validate([
            'leader' => 'required',
            'reason' => 'required',
        ]);
        if ($request->requestedBy == 2) {
            $request->validate(['reg_number' => 'required|min:9|numeric|exists:members,reg_no']);
        }
        if (Member::where('reg_no', $request->reg_number)->first()->status != 1) {
            return back()->with('warning', 'Unless Active Member Other can\'t Apply any service');
        }
        $member = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member_id : Member::where('reg_no', $request->reg_number)->first()->id;
        $church = ($request->requestedBy == 1) ? auth()->guard('member')->user()->member->local_church_id : Member::where('reg_no', $request->reg_number)->first()->local_church_id;
        $request->merge([
            'church' => $church,
            'applyBy' => auth()->guard('member')->user()->id,
            'member_id' => $member,
        ]);

        LeaderMeetRequest::create($request->all());
        return to_route('member.request.leaderMeetRequestList')->with('success', 'Application successfully Sent');
    }
    // destroyLeaderMeetRequest
    public function destroyLeaderMeetRequest($id)
    {
        LeaderMeetRequest::where('id', $id)->first()->delete();
        return back()->with('success', 'Deleted successfully');
    }

}
