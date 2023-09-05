<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\RwandaGeography;
use Illuminate\Support\Facades\DB;

class OfficeRegistration extends Controller
{
    //region
    public function region()
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        $regions = Office::where('type', 'region')->select('offices.*'
        , DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = offices.province_id LIMIT 1) as province')
        , DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = offices.district_id LIMIT 1) as district')
        , DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = offices.sector_id LIMIT 1) as sector')
        , DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = offices.cell_id LIMIT 1) as cell')
        , DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = offices.village_id LIMIT 1) as village'))
        ->get();

        return view('office.headquarter.region',compact('provinces', 'regions'));
    }
    //parish
    public function parish()
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        $regions = Office::where('type', 'region')->orderBy('name')->get();

        return view('office.headquarter.parish', compact('regions', 'provinces'));
    }
    // parishApi
    public function parishesApi()
    {
        $parishes =  Office::where('offices.type', 'parish')
        ->leftJoin('offices as regions', 'offices.region_number', '=', 'regions.reg_number')->select('offices.*','regions.name as region_name'
        , DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = offices.province_id LIMIT 1) as province')
        , DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = offices.district_id LIMIT 1) as district')
        , DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = offices.sector_id LIMIT 1) as sector')
        , DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = offices.cell_id LIMIT 1) as cell')
        , DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = offices.village_id LIMIT 1) as village'))
        ->orderBy('offices.reg_number')->get();
        return response()->json($parishes);
    }
    //localChurch.
    public function localChurch()
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        $regions = Office::where('type', 'region')->orderBy('name')->get();


        return view('office.headquarter.local-church', compact('regions', 'provinces'));
    }
    // localChurchApi
    public function localChurchApi()
    {
        $localChurches =  Office::where('offices.type', 'local-church')
        ->leftJoin('offices as regions', 'offices.region_number', '=', 'regions.reg_number')
        ->leftJoin('offices as parishes', 'offices.parish_number', '=', 'parishes.reg_number')
        ->select('offices.*','regions.name as region_name','parishes.name as parish_name'
        , DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = offices.province_id LIMIT 1) as province')
        , DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = offices.district_id LIMIT 1) as district')
        , DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = offices.sector_id LIMIT 1) as sector')
        , DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = offices.cell_id LIMIT 1) as cell')
        , DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = offices.village_id LIMIT 1) as village'))
        ->orderBy('offices.reg_number')->get();
        return response()->json($localChurches);
    }

    //get districts
    public function getDistricts($province)
    {
        $districts = RwandaGeography::select('Dist_ID', 'District')->where('Prov_ID', $province)->groupBy('Dist_ID')->get();
        return response()->json($districts);
    }
    // get sectors
    public function getSectors($district)
    {
        $sectors = RwandaGeography::select('Sect_ID', 'Sector')->where('Dist_ID', $district)->groupBy('Sect_ID')->get();
        return response()->json($sectors);
    }
    // get cells
    public function getCells($sector)
    {
        $cells = RwandaGeography::select('Cell_ID', 'Cell')->where('Sect_ID', $sector)->groupBy('Cell_ID')->get();
        return response()->json($cells);
    }
    // get villages
    public function getVillages($cell)
    {
        $villages = RwandaGeography::select('Vill_ID', 'Village')->where('Cell_ID', $cell)->groupBy('Vill_ID')->get();
        return response()->json($villages);
    }
    public function getParishes($parish)
    {

        $parishes =  Office::where('offices.type', 'parish')->where('offices.region_number', $parish)
        ->leftJoin('offices as regions', 'offices.region_number', '=', 'regions.reg_number')->select('offices.*','regions.name as region_name'
        , DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = offices.province_id LIMIT 1) as province')
        , DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = offices.district_id LIMIT 1) as district')
        , DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = offices.sector_id LIMIT 1) as sector')
        , DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = offices.cell_id LIMIT 1) as cell')
        , DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = offices.village_id LIMIT 1) as village'))
        ->get();
        return response()->json($parishes);
    }
    // getChurches
    public function getChurches($church)
    {
        $localChurches =  Office::where('offices.type', 'local-church')->where('offices.parish_number', $church)
        ->leftJoin('offices as regions', 'offices.region_number', '=', 'regions.reg_number')
        ->leftJoin('offices as parishes', 'offices.parish_number', '=', 'parishes.reg_number')
        ->select('offices.*','regions.name as region_name','parishes.name as parish_name'
        , DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = offices.province_id LIMIT 1) as province')
        , DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = offices.district_id LIMIT 1) as district')
        , DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = offices.sector_id LIMIT 1) as sector')
        , DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = offices.cell_id LIMIT 1) as cell')
        , DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = offices.village_id LIMIT 1) as village'))
        ->orderBy('offices.reg_number')->get();
        return response()->json($localChurches);
    }

    // storeRegion
    public function storeRegion(Request $request)
    {
        $request->validate([
            'province' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'cell' => 'required',
            'village' => 'required',
            'name' => 'required',
        ]);

        // check if name already exists where type is region
        $check = Office::where('name', $request->name)->where('type', 'region')->first();
        if ($check) {
            return redirect()->back()->with('error', 'Region already exists.');
        }
       Office::create([
            'province_id' => $request->province,
            'district_id' => $request->district,
            'sector_id' => $request->sector,
            'cell_id' => $request->cell,
            'village_id' => $request->village,
            'name' => $request->name,
            'type' => 'region',
            'reg_number' => Office::where('type', 'region')->count() + 1,
            'user_id' => auth()->user()->id,
        ]);
         return redirect()->back()->with('success', 'Office created successfully.');

    }
    // updateRegion
    public function updateRegion(Request $request, $id)
    {
        $request->validate([
            'province' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'cell' => 'required',
            'village' => 'required',
            'name' => 'required',
        ]);
        // check if name on type region not in 2 times
        $check = Office::where('name', $request->name)->where('type', 'region')->where('id', '!=', $id)->first();
        if ($check) {
            return redirect()->back()->with('error', 'Region already exists.');
        }
        Office::findorfail($id)->update([
            'province_id' => $request->province,
            'district_id' => $request->district,
            'sector_id' => $request->sector,
            'cell_id' => $request->cell,
            'village_id' => $request->village,
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Office updated successfully.');

    }

    // storeParish
    public function storeParish(Request $request)
    {
        $request->validate([
            'province' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'cell' => 'required',
            'village' => 'required',
            'name' => 'required',
            'region' => 'required',
        ]);

        // check if name already exists where type is parish
        $check = Office::where('name', $request->name)->where('type', 'parish')->first();
        if ($check) {
            return redirect()->back()->with('error', 'Parish already exists.');
        }
        $reg = str_pad(Office::where('type', 'parish')->where('region_number', $request->region)->count() + 1, 2, '0', STR_PAD_LEFT);
        try {
            Office::create([
                'province_id' => $request->province,
                'district_id' => $request->district,
                'sector_id' => $request->sector,
                'cell_id' => $request->cell,
                'village_id' => $request->village,
                'name' => $request->name,
                'type' => 'parish',
                'reg_number' => $request->region . $reg,
                'region_number' => $request->region,
                'user_id' => auth()->user()->id,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong. Ask for help.');
        }
        return redirect()->back()->with('success', 'Office created successfully.');

    }
    // updateParish
    public function updateParish(Request $request, $id)
    {
        $request->validate([
            'province' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'cell' => 'required',
            'village' => 'required',
            'name' => 'required',
        ]);
        // check if name on type parish not in 2 times
        $check = Office::where('name', $request->name)->where('type', 'parish')->where('id', '!=', $id)->first();
        if ($check) {
            return redirect()->back()->with('error', 'Parish already exists.');
        }
        Office::findorfail($id)->update([
            'province_id' => $request->province,
            'district_id' => $request->district,
            'sector_id' => $request->sector,
            'cell_id' => $request->cell,
            'village_id' => $request->village,
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Office updated successfully.');

    }
    // storeLocalChurch
    public function storeLocalChurch(Request $request)
    {
        $request->validate([
            'province' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'cell' => 'required',
            'village' => 'required',
            'name' => 'required',
            'parish' => 'required',
            'region' => 'required',
        ]);

        // check if name already exists where type is local church
        $check = Office::where('name', $request->name)->where('parish_number',$request->parish)->first();
        if ($check) {
            return redirect()->back()->with('error', 'Local church already exists.');
        }
        $reg = str_pad(Office::where('parish_number',$request->parish)->count() + 1, 2, '0', STR_PAD_LEFT);
        Office::create([
            'province_id' => $request->province,
            'district_id' => $request->district,
            'sector_id' => $request->sector,
            'cell_id' => $request->cell,
            'village_id' => $request->village,
            'name' => $request->name,
            'type' => 'local-church',
            'reg_number' => $request->parish . $reg,
            'region_number' => $request->region,
            'parish_number' => $request->parish,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Office created successfully.');
    }
    // updateLocalChurch
    public function updateLocalChurch(Request $request, $id)
    {
        $request->validate([
            'province' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'cell' => 'required',
            'village' => 'required',
            'name' => 'required',
        ]);
        // check if name on type local church not in 2 times
        $check = Office::where('name', $request->name)->where('type', 'local-church')->where('id', '!=', $id)->first();
        if ($check) {
            return redirect()->back()->with('error', 'Local church already exists.');
        }
        Office::findorfail($id)->update([
            'province_id' => $request->province,
            'district_id' => $request->district,
            'sector_id' => $request->sector,
            'cell_id' => $request->cell,
            'village_id' => $request->village,
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Office updated successfully.');
    }
}
