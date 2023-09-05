<?php

namespace App\Http\Controllers\LocalChurch;

use App\Models\Member;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\RwandaGeography;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\ClassMember;
use App\Models\Family;
use App\Models\MemberStep;

class MemberResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::where('local_church_id', auth()->user()->local_church_id)->select('members.*'
        , DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = members.province_id LIMIT 1) as province')
        , DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = members.district_id LIMIT 1) as district')
        , DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = members.sector_id LIMIT 1) as sector')
        , DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = members.cell_id LIMIT 1) as cell')
        , DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = members.village_id LIMIT 1) as village'))
        ->get();
        return view('members.christian.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        return view('members.christian.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request)
    {
        $churchRegNo = Office::findorfail(auth()->user()->local_church_id)->reg_number;
      $countMember = Member::where('local_church_id', auth()->user()->local_church_id)->count();
      $index = str_pad($countMember + 1, 4, '0', STR_PAD_LEFT);

      $fields = [];
      $ministries = [];
      if ($request->field == null) {
        $field = null;
      } else {
        foreach ($request->field as $field) {
            $fields[] = $field;
        }
        $field = implode(',', $fields);
      }

        foreach ($request->ministry as $ministry) {
            $ministries[] = $ministry;
        }
        $ministry = implode(',', $ministries);
        $request->merge([
            'reg_no' => $churchRegNo.$index,
            'province_id' => $request->province,
            'district_id' => $request->district,
            'sector_id' => $request->sector,
            'cell_id' => $request->cell,
            'village_id' => $request->village,
            'region_id' => auth()->user()->region_id,
            'parish_id' => auth()->user()->parish_id,
            'local_church_id' => auth()->user()->local_church_id,
            'user_id' => auth()->user()->id,
            'field_id' => $field,
            'ministry_id' => $ministry,
            'insurance_id' => $request->insurance,
            'saving_id' => $request->saving,
            'marital_status_id' => $request->marital_status,
            'education_id' => $request->education,
        ]);
        Member::create($request->all());
        return redirect()->route('localChurch.member.index')->with('success', 'Member registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $regions = Office::where('type', 'region')->get();
        $member = Member::where('id',$id)->select('members.*',
        DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = members.province_id LIMIT 1) as province'),
        DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = members.district_id LIMIT 1) as district'),
        DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = members.sector_id LIMIT 1) as sector'),
        DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = members.cell_id LIMIT 1) as cell'),
        DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = members.village_id LIMIT 1) as village')
    )->first();

      $childPrayer = MemberStep::where('member_id', $id)->where('step', 'childPrayer')->first();
      $baptism = MemberStep::where('member_id', $id)->where('step', 'baptism')->first();
      $marriage = MemberStep::where('member_id', $id)->where('step', 'mariage')->first();

      @$family_id = Family::where('member_id', $id)->first()->family_id;

      $families = Family::where('family_id', $family_id)->get();

       $classes = ClassMember::where('member_id',$id)->get();
        return view('members.christian.show', compact('member', 'regions', 'childPrayer', 'baptism', 'marriage','families','classes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        $member = Member::where('id',$id)->select('members.*',
        DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = members.province_id LIMIT 1) as province'),
        DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = members.district_id LIMIT 1) as district'),
        DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = members.sector_id LIMIT 1) as sector'),
        DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = members.cell_id LIMIT 1) as cell'),
        DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = members.village_id LIMIT 1) as village')
    )->first();
        return view('members.christian.edit', compact('member', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // validate the data
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'nullable', 'email',
            'phone' => 'nullable|numeric|digits:10|unique:members,phone,'.$id,
            'nid' => 'nullable|numeric|digits:16|unique:members,nid,'.$id,
            'province' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'cell' => 'required',
            'village' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'dateOfBirth' => 'required|date',
            'education' => 'required',
            'disability' => 'nullable',
            'training' => 'nullable',
            'professional' => 'nullable',
            'employer' => 'nullable',
            'field' => 'nullable|array',
            'insurance' => 'required',
            'saving' => 'nullable',
            'ministry' => 'required|array',
            'relation' => 'required',
            'status' => 'required',
        ]);

      $fields = [];
      $ministries = [];
      if ($request->field == null) {
        $field = null;
      } else {
        foreach ($request->field as $field) {
            $fields[] = $field;
        }
        $field = implode(',', $fields);
      }

        foreach ($request->ministry as $ministry) {
            $ministries[] = $ministry;
        }
        $ministry = implode(',', $ministries);
        $request->merge([
            'province_id' => $request->province,
            'district_id' => $request->district,
            'sector_id' => $request->sector,
            'cell_id' => $request->cell,
            'village_id' => $request->village,
            'field_id' => $field,
            'ministry_id' => $ministry,
            'insurance_id' => $request->insurance,
            'saving_id' => $request->saving,
            'marital_status_id' => $request->marital_status,
            'education_id' => $request->education,
        ]);
        Member::where('id',$id)->first()->update($request->all());
        return redirect()->route('localChurch.member.index')->with('success', 'Member Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Member::where('id',$id)->delete();
        return redirect()->route('localChurch.member.index')->with('success', 'Member Deleted successfully');
    }
    public function storeChildPrayer(Request $request,$id)
    {
       $request->validate([
        'date' => 'required',
        'region' => 'required',
        'parish' => 'required',
        'local_church' => 'required',]);
         $request->merge([
          'step' => 'childPrayer',
          'member_id' => $id,
          'region_id' => Office::where('reg_number', $request->region)->first()->id,
          'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
          'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
         ]);

         MemberStep::create($request->all());
         return redirect()->back()->with('success', 'Child Prayer registered successfully');
    }
    // storeBaptism
    public function storeBaptism(Request $request,$id)
    {
       $request->validate([
        'date' => 'required',
        'region' => 'required',
        'parish' => 'required',
        'local_church' => 'required',]);
         $request->merge([
          'step' => 'baptism',
          'member_id' => $id,
          'region_id' => Office::where('reg_number', $request->region)->first()->id,
          'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
          'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
         ]);

         MemberStep::create($request->all());
         return redirect()->back()->with('success', 'Baptism registered successfully');
    }
    // storeMarriage
    public function storeMarriage(Request $request,$id)
    {
       $request->validate([
        'date' => 'required',
        'spouse_name' => 'required',
        'region' => 'required',
        'parish' => 'required',
        'local_church' => 'required',]);
         $request->merge([
          'step' => 'mariage',
          'member_id' => $id,
          'region_id' => Office::where('reg_number', $request->region)->first()->id,
          'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
          'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
         ]);

         MemberStep::create($request->all());
         return redirect()->back()->with('success', 'Marriage registered successfully');
    }

    // updateChildPrayer
    public function updateChildPrayer(Request $request,$id)
    {
       $request->validate([
        'date' => 'required',
        'region' => 'required',
        'parish' => 'required',
        'local_church' => 'required',]);
         $request->merge([
          'region_id' => Office::where('reg_number', $request->region)->first()->id,
          'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
          'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
         ]);

         MemberStep::where('member_id',$id)->where('step','childPrayer')->first()->update($request->all());
         return redirect()->back()->with('success', 'Child Prayer updated successfully');
    }
    // updateBaptism
    public function updateBaptism(Request $request,$id)
    {
       $request->validate([
        'date' => 'required',
        'region' => 'required',
        'parish' => 'required',
        'local_church' => 'required',]);
         $request->merge([
          'region_id' => Office::where('reg_number', $request->region)->first()->id,
          'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
          'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
         ]);

         MemberStep::where('member_id',$id)->where('step','baptism')->first()->update($request->all());

         return redirect()->back()->with('success', 'Baptism updated successfully');
    }
    // updateMarriage
    public function updateMarriage(Request $request,$id)
    {
       $request->validate([
        'date' => 'required',
        'spouse_name' => 'required',
        'region' => 'required',
        'parish' => 'required',
        'local_church' => 'required',]);
         $request->merge([
          'region_id' => Office::where('reg_number', $request->region)->first()->id,
          'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
          'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
         ]);

         MemberStep::where('member_id',$id)->where('step','mariage')->first()->update($request->all());
         return redirect()->back()->with('success', 'Marriage updated successfully');
    }
    // storeFamily
    public function storeFamily($id)
    {
       $hasFamily = Family::where('member_id',$id)->first();
         if($hasFamily){
          return redirect()->back()->with('error', 'Family already registered');
         }
        Family::create(['member_id' => $id,'family_id' => $id,'relation' => 'head']);
         return redirect()->back()->with('success', 'Family registered successfully');
    }
    // addChild
    public function addChild($id)
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        return view('members.children.create', compact('provinces','id'));
    }
    // assignMember
    public function assignMember(Request $request,$id)
    {
        // check family header
        $hasFamily = Family::where('member_id',$request->member_id)->first();
        if(!$hasFamily){
          return redirect()->back()->with('error', 'Selected member Not Yet Create Family');
        }
        $belongIn = Family::where('member_id',$id)->first();
        if($belongIn){
          return redirect()->back()->with('error', 'Member already Belong To Family');
        }
        $member = Member::where('id',$id)->first();

        function addFamily($relation,$id,$request)  {
            Family::create(['member_id' => $id,'family_id' => $request->member_id,'relation' => $relation]);
        }

        if ($member->relation == 2) {
        $checkSpouse = Family::where('family_id',$request->member_id)->where('relation','spouse')->first();
         if ($checkSpouse) {
            return redirect()->back()->with('error', 'Spouse already Belong Family');
         }
            addFamily('spouse',$id,$request);
        } else if ($member->relation == 3) {
            addFamily('child',$id,$request);
        } else {
            addFamily('other',$id,$request);
        }

        return redirect()->back()->with('success', 'Member assigned successfully');

    }
    // destroyChild
    public function destroyChild($id)
    {
        $family = Family::where('id',$id)->first();
        if ($family->relation == 'head') {
            Family::where('family_id',$family->member_id)->delete();
            return redirect()->back()->with('success', 'Family Deleted Successfully');
        }
        Family::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Member Deleted Successfully');
    }

}
