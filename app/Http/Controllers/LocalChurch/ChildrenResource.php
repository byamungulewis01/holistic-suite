<?php

namespace App\Http\Controllers\LocalChurch;

use App\Models\Family;
use App\Models\Children;
use Illuminate\Http\Request;
use App\Models\RwandaGeography;
use App\Models\SundaySchoolMember;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChildrenResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $children = Children::where('local_church_id', auth()->user()->local_church_id)->get();
     return view('members.children.index', compact('children'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        return view('members.children.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // validate the data
            $request->validate
            ([
                'name' => 'required|min:5|string',
                'fatherName' => 'required|min:5|string',
                'motherName' => 'required|min:5|string',
                'parentPhone' => 'required|numeric|digits:10',
                'province' => 'required',
                'district' => 'required',
                'sector' => 'required',
                'cell' => 'required',
                'village' => 'required',
                'gender' => 'required',
                'dateOfBirth' => 'required|date',
                'dateOfPrayer' => 'nullable|date',
                'education' => 'required',
                'disability' => 'nullable',
                'insurance' => 'required',
                'status' => 'required',
                'orphanStatus' => 'required',
            ]);

            $request->merge([
                'province_id' => $request->province,
                'district_id' => $request->district,
                'sector_id' => $request->sector,
                'cell_id' => $request->cell,
                'village_id' => $request->village,
                'insurance_id' => $request->insurance,
                'education_id' => $request->education,
                'region_id' => auth()->user()->region_id,
                'parish_id' => auth()->user()->parish_id,
                'local_church_id' => auth()->user()->local_church_id,
                'user_id' => auth()->user()->id,
                'member_id' => ($request->has('member_id') ? $request->member_id : null),
            ]);
            $child = Children::create($request->all());
            if($request->has('sunday_school_id')) {
                SundaySchoolMember::create([
                    'sunday_school_id' => $request->sunday_school_id,
                    'child_id' =>  $child->id,
                ]);
             return redirect()->route('localChurch.sundaySchool.members',$request->sunday_school_id)->with('success', 'Child created successfully.');
            }
            if ($request->member_id != null) {
                Family::create([
                    'family_id' => $request->member_id,
                    'child_id' => $child->id,
                    'relation' => 'child',
                ]);
             return redirect()->route('localChurch.member.show',$request->member_id)->with('success', 'Child created successfully.');
            }
            return redirect()->route('localChurch.children.index')->with('success', 'Child created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $child = Children::where('id',$id)->select('childrens.*',
        DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = childrens.province_id LIMIT 1) as province'),
        DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = childrens.district_id LIMIT 1) as district'),
        DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = childrens.sector_id LIMIT 1) as sector'),
        DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = childrens.cell_id LIMIT 1) as cell'),
        DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = childrens.village_id LIMIT 1) as village')
    )->first();

    $school = SundaySchoolMember::where('child_id', $id)->first();
    $family = Family::where('child_id', $id)->first();

    @$familyMembers = Family::where('family_id', $family->family_id)->get();
    return view('members.children.show', compact('child', 'school', 'familyMembers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        $child = Children::where('id',$id)->select('childrens.*',
        DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = childrens.province_id LIMIT 1) as province'),
        DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = childrens.district_id LIMIT 1) as district'),
        DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = childrens.sector_id LIMIT 1) as sector'),
        DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = childrens.cell_id LIMIT 1) as cell'),
        DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = childrens.village_id LIMIT 1) as village')
    )->first();
        return view('members.children.edit', compact('child', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all(), $id);
              // validate the data
               $request->validate([
                  'name' => 'required|min:5|string',
                  'fatherName' => 'required|min:5|string',
                  'motherName' => 'required|min:5|string',
                  'parentPhone' => 'required|numeric|digits:10',
                  'province' => 'required',
                  'district' => 'required',
                  'sector' => 'required',
                  'cell' => 'required',
                  'village' => 'required',
                  'gender' => 'required',
                  'dateOfBirth' => 'required|date',
                  'dateOfPrayer' => 'nullable|date',
                  'education' => 'required',
                  'disability' => 'nullable',
                  'insurance' => 'required',
                  'status' => 'required',
                  'orphanStatus' => 'required',
              ]);

              $request->merge([
                  'province_id' => $request->province,
                  'district_id' => $request->district,
                  'sector_id' => $request->sector,
                  'cell_id' => $request->cell,
                  'village_id' => $request->village,
                  'insurance_id' => $request->insurance,
                  'education_id' => $request->education,
              ]);
                $child = Children::where('id', $id)->first();
                $child->update($request->all());
                return redirect()->route('localChurch.children.index')->with('success', 'Child updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete Children Model
        Children::where('id', $id)->delete();
        return redirect()->route('localChurch.children.index')->with('success', 'Child deleted successfully.');
    }
    // assignMember
    public function assignMember(Request $request, string $id)
    {
       Family::create(['child_id' => $id, 'family_id' => $request->member_id, 'relation' => 'child']);
       return redirect()->back()->with('success', 'Child assigned successfully.');
    }
}
