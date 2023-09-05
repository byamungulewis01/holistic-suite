<?php

namespace App\Http\Controllers\LocalChurch;

use App\Models\Calling;
use App\Models\Children;
use App\Models\SundaySchool;
use Illuminate\Http\Request;
use App\Models\RwandaGeography;
use App\Models\SundaySchoolMember;
use App\Http\Controllers\Controller;

class SundaySchoolController extends Controller
{
    //index
    public function index()
    {
        $teachers = Calling::where('local_church_id', auth()->user()->local_church_id)->where('type', 'sunday-school-teacher')->get();
        $schools = SundaySchool::where('local_church_id', auth()->user()->local_church_id)->get();
        return view('sunday-school.index', compact('schools', 'teachers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required',
            'class' => 'required',
            'teacher_id' => 'required',
        ]);

        $school = SundaySchool::where('level', $request->level)->where('class', $request->class)->where('local_church_id', auth()->user()->local_church_id)->first();
        if ($school) {
            return redirect()->route('localChurch.sundaySchool.index')->with('error', 'Sunday School Already Exist');
        }

        if ($request->level == 1) {
            $classIndex = 'SS1';
        } elseif ($request->level == 2) {
            $classIndex = 'SS2';
        } elseif ($request->level == 3) {
            $classIndex = 'SS3';
        } elseif ($request->level == 4) {
            $classIndex = 'SSC1';
        } elseif ($request->level == 5) {
            $classIndex = 'SSC2';
        } else {
            $classIndex = 'SSC3';
        }
        $request->merge([
            'classIndex' => $classIndex,
            'region_id' => auth()->user()->region_id,
            'parish_id' => auth()->user()->parish_id,
            'local_church_id' => auth()->user()->local_church_id,
            'user_id' => auth()->user()->id,
        ]);
        SundaySchool::create($request->all());
        return redirect()->route('localChurch.sundaySchool.index')->with('success', 'Sunday School Created successfully');
    }
    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'level' => 'required',
            'class' => 'required',
            'teacher_id' => 'required',
            'status' => 'required',
        ]);

        $school = SundaySchool::where('level', $request->level)->where('class', $request->class)->where('local_church_id', auth()->user()->local_church_id)->where('id', '!=', $id)->first();
        if ($school) {
            return redirect()->route('localChurch.sundaySchool.index')->with('error', 'Sunday School Already Exist');
        }
        if ($request->level == 1) {
            $classIndex = 'SS1';
        } elseif ($request->level == 2) {
            $classIndex = 'SS2';
        } elseif ($request->level == 3) {
            $classIndex = 'SS3';
        } elseif ($request->level == 4) {
            $classIndex = 'SSC1';
        } elseif ($request->level == 5) {
            $classIndex = 'SSC2';
        } else {
            $classIndex = 'SSC3';
        }
        $request->merge([
            'classIndex' => $classIndex,
        ]);

        SundaySchool::where('id', $id)->update($request->except('_token', '_method'));
        return redirect()->route('localChurch.sundaySchool.index')->with('success', 'Sunday School Updated successfully');
    }
    // destroy
    public function destroy($id)
    {
        SundaySchool::where('id', $id)->delete();
        return redirect()->route('localChurch.sundaySchool.index')->with('success', 'Sunday School Deleted successfully');
    }

    public function members($id)
    {
        $school = SundaySchool::where('id', $id)->first();
        $childrens = Children::where('local_church_id', auth()->user()->local_church_id)->get();
        $members = SundaySchoolMember::where('sunday_school_id', $id)->get();

        // all sunday school except $id

        $schools = SundaySchool::where('local_church_id', auth()->user()->local_church_id)->where('id', '!=', $id)->get();
        return view('sunday-school.members', compact('school', 'childrens', 'members', 'schools'));
    }
    // storeMember
    public function storeMember(Request $request, $id)
    {
        $request->validate([
            'children' => 'required',
        ]);

        foreach ($request->children as $value) {
            if (SundaySchoolMember::where('child_id', $value)->first()) {
                $name = Children::where('id', $value)->first()->name;
                return redirect()->back()->with('error', $name.'Already Has Sunday School Class');
            }
            SundaySchoolMember::create([
                'sunday_school_id' => $id,
                'child_id' => $value,
            ]);
        }
        return redirect()->back()->with('success', 'Member Added successfully');
    }
    public function addChild($sunday_school_id)
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        return view('members.children.create', compact('provinces','sunday_school_id'));
    }
    // destroyMember
    public function destroyMember($id)
    {
        SundaySchoolMember::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Member Deleted successfully');
    }
    // changeLevel
    public function changeLevel(Request $request,$id)
    {
        $request->validate([
            'level' => 'required',
        ]);
        SundaySchoolMember::where('id', $id)->update(['sunday_school_id' => $request->level]);
        return redirect()->back()->with('success', 'Member Level Changed successfully');
    }

}
