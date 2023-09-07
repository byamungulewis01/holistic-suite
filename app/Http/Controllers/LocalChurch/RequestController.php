<?php

namespace App\Http\Controllers\LocalChurch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recommand\Suggestion;
use App\Models\Recommand\PraiseRequest;
use App\Models\Recommand\PreachRequest;
use App\Models\Recommand\ChoirMoveRequest;
use App\Models\Recommand\LeaderMeetRequest;
use App\Models\Recommand\SocialMediaPreach;

class RequestController extends Controller
{

    public function suggestionList()
    {
        $collections = Suggestion::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.requests.suggestionList', compact('collections'));
    }
      // suggestionReply
      public function suggestionReply(Request $request, $id)
      {
          $record = Suggestion::findorfail($id);
          $record->update([
              'status' => 2,'repliedBy' => auth()->user()->id, 'reply' => $request->reply,
          ]);
          return back()->with('success', 'Submited successfully');
      }

    // Praise Request
    public function praiseRequestList()
    {
        $collections = PraiseRequest::where('local_church_id', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.requests.praiseRequestList', compact('collections'));
    }
      // praiseRequestApprove
      public function praiseRequestApprove(Request $request, $id)
      {
          $record = PraiseRequest::findorfail($id);
          $record->update([
              'status' => 2, 'aproovedDate' => now(),
              'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
          ]);
          return back()->with('success', 'Approved successfully');
      }
      // praiseRequestReject
      public function praiseRequestReject(Request $request, $id)
      {
          $record = PraiseRequest::findorfail($id);
          $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
          return back()->with('success', 'Rejected successfully');
      }


    public function preachRequestList()
    {
        $collections = PreachRequest::where('church', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.requests.preachRequestList', compact('collections'));
    }
      // preachRequestApprove
      public function preachRequestApprove(Request $request, $id)
      {
          $record = PreachRequest::findorfail($id);
          $record->update([
              'status' => 2, 'aproovedDate' => now(),
              'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
          ]);
          return back()->with('success', 'Approved successfully');
      }
      // preachRequestReject
      public function preachRequestReject(Request $request, $id)
      {
          $record = PreachRequest::findorfail($id);
          $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
          return back()->with('success', 'Rejected successfully');
      }

    public function socialMediaPreachList()
    {
        $collections = SocialMediaPreach::where('church', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.requests.socialMediaPreachList', compact('collections'));
    }
      // socialMediaPreachApprove
      public function socialMediaPreachApprove(Request $request, $id)
      {
          $record = SocialMediaPreach::findorfail($id);
          $record->update([
              'status' => 2, 'aproovedDate' => now(),
              'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
          ]);
          return back()->with('success', 'Approved successfully');
      }
      // socialMediaPreachReject
      public function socialMediaPreachReject(Request $request, $id)
      {
          $record = SocialMediaPreach::findorfail($id);
          $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
          return back()->with('success', 'Rejected successfully');
      }

    public function choirMoveList()
    {
        $collections = ChoirMoveRequest::where('church', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.requests.choirMoveList', compact('collections'));
    }
      // choirMoveApprove
      public function choirMoveApprove(Request $request, $id)
      {
          $record = ChoirMoveRequest::findorfail($id);
          $record->update([
              'status' => 2, 'aproovedDate' => now(),
              'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
          ]);
          return back()->with('success', 'Approved successfully');
      }
      // choirMoveReject
      public function choirMoveReject(Request $request, $id)
      {
          $record = ChoirMoveRequest::findorfail($id);
          $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
          return back()->with('success', 'Rejected successfully');
      }

    public function leaderMeetRequestList()
    {
        $collections = LeaderMeetRequest::where('church', auth()->user()->local_church_id)->orderBy('created_at', 'desc')->get();
        return view('online-service.requests.leaderMeetRequestList', compact('collections'));
    }
      // leaderMeetRequestApprove
      public function leaderMeetRequestApprove(Request $request, $id)
      {
          $record = LeaderMeetRequest::findorfail($id);
          $record->update([
              'status' => 2, 'aproovedDate' => now(),
              'aproovedBy' => auth()->user()->id, 'comment' => $request->comment,
          ]);
          return back()->with('success', 'Approved successfully');
      }
      // leaderMeetRequestReject
      public function leaderMeetRequestReject(Request $request, $id)
      {
          $record = LeaderMeetRequest::findorfail($id);
          $record->update(['status' => 3, 'rejectedDate' => now(), 'rejectedBy' => auth()->user()->id, 'comment' => $request->comment]);
          return back()->with('success', 'Rejected successfully');
      }


}
