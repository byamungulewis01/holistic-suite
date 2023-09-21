<?php

namespace App\Http\Controllers\LocalChurch;

use App\Models\Member;
use App\Models\Calling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallingController extends Controller
{
    //index
    public function index()
    {
        $callings = Calling::where('local_church_id', auth()->user()->local_church_id)->where('type','calling')->get();
        return view('calling.index', compact('callings'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $members = Member::where(function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', "%$searchTerm%");
            $query->orWhere('reg_no', 'LIKE', "%$searchTerm%");
            })->where('status',1)->where('local_church_id', auth()->user()->local_church_id)->get();

        return response()->json($members);
    }
    // store
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'category_id' => 'required',
        ]);
        $calling = Calling::where('member_id', $request->member_id)->where('local_church_id', auth()->user()->local_church_id)->first();

        if ($calling) {
            return redirect()->back()->with('error', 'Calling already assigned');
        }
        $request->merge([
            'type' => 'calling',
            'region_id' => auth()->user()->region_id,
            'parish_id' => auth()->user()->parish_id,
            'local_church_id' => auth()->user()->local_church_id,
            'user_id' => auth()->user()->id,
        ]);
        Calling::create($request->all());
        return redirect()->route('localChurch.calling.index')->with('success', 'Calling Assinged successfully');
    }
    // update
    public function update(Request $request, $id)
    {
        Calling::where('id', $id)->update([
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('localChurch.calling.index')->with('success', 'Calling Updated successfully');
    }
    // destroy
    public function destroy($id)
    {
        Calling::where('id', $id)->delete();
        return redirect()->route('localChurch.calling.index')->with('success', 'Calling Deleted successfully');
    }
    // sundaySchool
    public function sundaySchool()
    {
        $callings = Calling::where('local_church_id', auth()->user()->local_church_id)
        ->where('type','sunday-school-teacher')->get();
        return view('calling.sundaySchool', compact('callings'));
    }
        // sundaySchoolStore
        public function sundaySchoolStore(Request $request)
        {
            $request->validate([
                'member_id' => 'required',
            ]);
            $calling = Calling::where('member_id', $request->member_id)->where('local_church_id', auth()->user()->local_church_id)->first();

            if ($calling) {
                return redirect()->back()->with('error', 'Teacher already assigned');
            }
            $request->merge([
                'type' => 'sunday-school-teacher',
                'region_id' => auth()->user()->region_id,
                'parish_id' => auth()->user()->parish_id,
                'local_church_id' => auth()->user()->local_church_id,
                'user_id' => auth()->user()->id,
            ]);
            Calling::create($request->all());
            return redirect()->route('localChurch.calling.sundaySchool')->with('success', 'Teacher Assinged successfully');
        }
        // sundaySchoolUpdate
        public function sundaySchoolUpdate(Request $request, $id)
        {
            Calling::where('id', $id)->update([
                'status' => $request->status,
            ]);
            return redirect()->route('localChurch.calling.sundaySchool')->with('success', 'Teacher Updated successfully');
        }
        // sundaySchoolDestroy
        public function sundaySchoolDestroy($id)
        {
            Calling::where('id', $id)->delete();
            return redirect()->route('localChurch.calling.sundaySchool')->with('success', 'Teacher Deleted successfully');
        }
}
