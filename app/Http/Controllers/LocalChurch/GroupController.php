<?php

namespace App\Http\Controllers\LocalChurch;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    //index
    public function index()
    {
        $groups = Group::where('local_church_id', auth()->user()->local_church_id)->get();
        return view('groups.index', compact('groups'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ministry_id' => 'required',
            'startDate' => 'required',
        ]);
        $request->merge([
                'code' => 'G'.str_pad(Group::where('local_church_id', auth()->user()->local_church_id)->count()+1, 3, '0', STR_PAD_LEFT),
                'region_id' => auth()->user()->region_id,
                'parish_id' => auth()->user()->parish_id,
                'local_church_id' => auth()->user()->local_church_id,
                'user_id' => auth()->user()->id,
        ]);
        Group::create($request->all());
        return redirect()->route('localChurch.group.index')->with('success', 'Group Ministry Created successfully');
    }
    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'ministry_id' => 'required',
            'startDate' => 'required',
        ]);
        Group::where('id', $id)->update($request->except('_token', '_method'));
        return redirect()->route('localChurch.group.index')->with('success', 'Group Ministry Updated successfully');
    }
    // destroy
    public function destroy($id)
    {
        Group::where('id', $id)->delete();
        return redirect()->route('localChurch.group.index')->with('success', 'Group Ministry Deleted successfully');
    }


    // members
    public function members($id)
    {
        $group = Group::where('id', $id)->first();
        $groupMembers = GroupMember::where('group_id', $id)->orderBy('created_at', 'desc')->get();
        $leaders = GroupMember::where('group_id', $id)->where('isLeader',true)->orderBy('post')->get();
        return view('groups.members', compact('group', 'groupMembers', 'leaders'));
    }
    // storeGroupMember
    public function storeGroupMember(Request $request,$id)
    {
        $exist = GroupMember::where('group_id', $id)->where('member_id', $request->member_id)->first();
        if ($exist) {
            return redirect()->back()->with('error', 'Member already exist in this group');
        }
        $request->merge([
            'group_id' => $id,
            'member_id' => $request->member_id,
            'user_id' => auth()->user()->id,
        ]);
        GroupMember::create($request->all());
        return redirect()->back()->with('success', 'Member added to group successfully');
    }
    // destroyGroupMember
    public function destroyGroupMember($id)
    {
        GroupMember::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Member removed from group successfully');
    }
    // storeGroupLeader
    public function storeGroupLeader(Request $request,$id)
    {
        $exist = GroupMember::where('group_id', $id)->where('member_id', $request->member_id)->first();
        $existLeader = GroupMember::where('group_id', $id)->where('post', $request->post)->first();
        if ($exist) {
            if ($exist->isLeader) {
                return redirect()->back()->with('error', 'Member already a leader in this group');
            }elseif ($existLeader) {
                if ($request->post == 1) {
                    $post = __('message.leadersPost.0.name');
                }elseif ($request->post == 2) {
                    $post = __('message.leadersPost.1.name');
                }elseif ($request->post == 3) {
                    $post = __('message.leadersPost.2.name');
                }
                return redirect()->back()->with('error', $post.' Post Already in this group');
            }else{
                $exist->update([
                    'isLeader' => true,
                    'post' => $request->post,
                ]);
                return redirect()->back()->with('success', 'Member added to group successfully');
            }
        }

        $request->merge([
            'group_id' => $id,
            'member_id' => $request->member_id,
            'user_id' => auth()->user()->id,
            'isLeader' => true,
        ]);
        GroupMember::create($request->all());
        return redirect()->back()->with('success', 'Member added to group successfully');
    }

    // removeGroupLeader
    public function removeGroupLeader(Request $request,$id)
    {
        $exist = GroupMember::where('group_id', $id)->where('member_id', $request->member_id)->first();
        if ($exist) {
            $exist->update([
                'isLeader' => false,
                'post' => null,
            ]);
            return redirect()->back()->with('success', 'Member removed from group successfully');
        }
        return redirect()->back()->with('error', 'Member not found');
    }

}
