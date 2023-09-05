<?php

namespace App\Http\Controllers\LocalChurch;

use Illuminate\Http\Request;
use App\Models\RwandaGeography;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Teenager;

class TeenagerResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teenagers = Teenager::where('local_church_id', auth()->user()->local_church_id)->get();
        return view('members.teenager.index', compact('teenagers'));
    }
//    teenagerApi
    public function teenagerApi()
    {
        $teenagers = Teenager::where('local_church_id', auth()->user()->local_church_id)->where('status',1)->get();
        return response()->json($teenagers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        return view('members.teenager.create', compact('provinces'));
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
            'province' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'cell' => 'required',
            'village' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required|date',
            'education' => 'required',
            'disability' => 'nullable',
            'insurance' => 'required',
            'saving' => 'nullable',
        ]);

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
            'insurance_id' => $request->insurance,
            'saving_id' => $request->saving,
            'education_id' => $request->education,
        ]);

        // if dateOfBirth < 10 years
        $dateOfBirth = $request->dateOfBirth;
        $dateOfBirth = date('Y-m-d', strtotime($dateOfBirth));
        $dateOfBirth = strtotime($dateOfBirth);
        $dateOfBirth = date('Y', $dateOfBirth);
        $dateOfBirth = (int) $dateOfBirth;
        $currentYear = date('Y');
        $currentYear = (int) $currentYear;
        $age = $currentYear - $dateOfBirth;
        if ($age < 10) {
            return redirect()->back()->with('error', 'Age must be greater than 10 years');
        }
        Teenager::create($request->all());
        return redirect()->route('localChurch.teenager.index')->with('success', 'Member registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = Teenager::where('id',$id)->select('teenagers.*',
        DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = teenagers.province_id LIMIT 1) as province'),
        DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = teenagers.district_id LIMIT 1) as district'),
        DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = teenagers.sector_id LIMIT 1) as sector'),
        DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = teenagers.cell_id LIMIT 1) as cell'),
        DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = teenagers.village_id LIMIT 1) as village')
    )->first();
        return view('members.teenager.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        $teenager = Teenager::where('id',$id)->select('teenagers.*',
        DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = teenagers.province_id LIMIT 1) as province'),
        DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = teenagers.district_id LIMIT 1) as district'),
        DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = teenagers.sector_id LIMIT 1) as sector'),
        DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = teenagers.cell_id LIMIT 1) as cell'),
        DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = teenagers.village_id LIMIT 1) as village')
    )->first();
        return view('members.teenager.edit', compact('teenager', 'provinces'));
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
            'province' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'cell' => 'required',
            'village' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required|date',
            'education' => 'required',
            'disability' => 'nullable',
            'insurance' => 'required',
            'saving' => 'nullable',
        ]);


        $request->merge([
            'province_id' => $request->province,
            'district_id' => $request->district,
            'sector_id' => $request->sector,
            'cell_id' => $request->cell,
            'village_id' => $request->village,
            'insurance_id' => $request->insurance,
            'saving_id' => $request->saving,
            'education_id' => $request->education,
        ]);

        // if dateOfBirth < 10 years
        $dateOfBirth = $request->dateOfBirth;
        $dateOfBirth = date('Y-m-d', strtotime($dateOfBirth));
        $dateOfBirth = strtotime($dateOfBirth);
        $dateOfBirth = date('Y', $dateOfBirth);
        $dateOfBirth = (int) $dateOfBirth;
        $currentYear = date('Y');
        $currentYear = (int) $currentYear;
        $age = $currentYear - $dateOfBirth;
        if ($age < 10) {
            return redirect()->back()->with('error', 'Age must be greater than 10 years');
        }

        $teenager = Teenager::where('id',$id)->first();
        $teenager->update($request->all());
        return redirect()->route('localChurch.teenager.index')->with('success', 'Teenager updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Teenager::where('id',$id)->delete();
        return redirect()->route('localChurch.teenager.index')->with('success', 'Teenager deleted successfully');
    }
}
