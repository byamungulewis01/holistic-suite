<?php

namespace App\Http\Controllers\LocalChurch;

use App\Models\Friend;
use Illuminate\Http\Request;
use App\Models\RwandaGeography;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FriendResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Friend::where('local_church_id', auth()->user()->local_church_id)->get();
        return view('members.freinds.index', compact('members'));
    }
    // friendApi
    public function friendApi()
    {
        $members = Friend::where('local_church_id', auth()->user()->local_church_id)->where('status',1)->get();
        return response()->json($members);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        return view('members.freinds.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'nullable', 'email',
            'phone' => 'nullable|numeric|digits:10',
            'nid' => 'nullable|numeric|digits:16|unique:friends,nid',
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
            'relation' => 'required',
            'religion' => 'required',
        ]);

      $fields = [];
      if ($request->field == null) {
        $field = null;
      } else {
        foreach ($request->field as $field) {
            $fields[] = $field;
        }
        $field = implode(',', $fields);
      }
        $request->merge([
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
            'insurance_id' => $request->insurance,
            'saving_id' => $request->saving,
            'marital_status_id' => $request->marital_status,
            'education_id' => $request->education,
            'previus_religion_id' => $request->religion,
        ]);
        Friend::create($request->all());
        return redirect()->route('localChurch.friend.index')->with('success', 'Friend created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = Friend::where('id',$id)->select('friends.*',
        DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = friends.province_id LIMIT 1) as province'),
        DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = friends.district_id LIMIT 1) as district'),
        DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = friends.sector_id LIMIT 1) as sector'),
        DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = friends.cell_id LIMIT 1) as cell'),
        DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = friends.village_id LIMIT 1) as village')
    )->first();
        return view('members.freinds.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        $member = Friend::where('id',$id)->select('friends.*',
        DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = friends.province_id LIMIT 1) as province'),
        DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = friends.district_id LIMIT 1) as district'),
        DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = friends.sector_id LIMIT 1) as sector'),
        DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = friends.cell_id LIMIT 1) as cell'),
        DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = friends.village_id LIMIT 1) as village')
    )->first();
        return view('members.freinds.edit', compact('member', 'provinces'));
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
            'phone' => 'nullable|numeric|digits:10',
            'nid' => 'nullable|numeric|digits:16|unique:friends,nid,'.$id,
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
            'relation' => 'required',
            'religion' => 'required',
        ]);

      $fields = [];
      if ($request->field == null) {
        $field = null;
      } else {
        foreach ($request->field as $field) {
            $fields[] = $field;
        }
        $field = implode(',', $fields);
      }

        $request->merge([
            'province_id' => $request->province,
            'district_id' => $request->district,
            'sector_id' => $request->sector,
            'cell_id' => $request->cell,
            'village_id' => $request->village,
            'field_id' => $field,
            'insurance_id' => $request->insurance,
            'saving_id' => $request->saving,
            'marital_status_id' => $request->marital_status,
            'education_id' => $request->education,
            'previus_religion_id' => $request->religion,
        ]);
        Friend::where('id',$id)->first()->update($request->all());
        return redirect()->route('localChurch.friend.index')->with('success', 'Friend updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Friend::where('id',$id)->delete();
        return redirect()->route('localChurch.friend.index')->with('success', 'Friend deleted successfully.');
    }
}
