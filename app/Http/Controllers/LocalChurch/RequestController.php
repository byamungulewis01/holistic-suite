<?php

namespace App\Http\Controllers\LocalChurch;

use App\Http\Controllers\Controller;
use App\Models\Recommand\ChoirMoveRequest;
use App\Models\Recommand\LeaderMeetRequest;
use App\Models\Recommand\PraiseRequest;
use App\Models\Recommand\PreachRequest;
use App\Models\Recommand\SocialMediaPreach;
use App\Models\Recommand\Suggestion;

class RequestController extends Controller
{

    public function suggestionList()
    {
        $collections = Suggestion::orderBy('created_at', 'desc')->get();
        return view('online-service.requests.suggestionList', compact('collections'));
    }

    // Praise Request
    public function praiseRequestList()
    {
        $collections = PraiseRequest::orderBy('created_at', 'desc')->get();
        return view('online-service.requests.praiseRequestList', compact('collections'));
    }

    public function preachRequestList()
    {
        $collections = PreachRequest::orderBy('created_at', 'desc')->get();
        return view('online-service.requests.preachRequestList', compact('collections'));
    }
    public function socialMediaPreachList()
    {
        $collections = SocialMediaPreach::orderBy('created_at', 'desc')->get();
        return view('online-service.requests.socialMediaPreachList', compact('collections'));
    }
    public function choirMoveList()
    {
        $collections = ChoirMoveRequest::orderBy('created_at', 'desc')->get();
        return view('online-service.requests.choirMoveList', compact('collections'));
    }
    public function leaderMeetRequestList()
    {
        $collections = LeaderMeetRequest::orderBy('created_at', 'desc')->get();
        return view('online-service.requests.leaderMeetRequestList', compact('collections'));
    }

}
