<?php

namespace App\Http\Controllers\Parish;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\RwandaGeography;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OfficeRegistration extends Controller
{
    //
    public function localChurch()
    {
        $provinces = RwandaGeography::select('Prov_ID', 'Province')->groupBy('Prov_ID')->get();
        $parish = Office::findorfail(auth()->user()->parish_id)->reg_number;
        $localChurches = Office::where('type', 'local-church')->where('parish_number', $parish)->select('offices.*'
            , DB::raw('(SELECT Province FROM rwanda_geography WHERE Prov_ID = offices.province_id LIMIT 1) as province')
            , DB::raw('(SELECT District FROM rwanda_geography WHERE Dist_ID = offices.district_id LIMIT 1) as district')
            , DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = offices.sector_id LIMIT 1) as sector')
            , DB::raw('(SELECT Cell FROM rwanda_geography WHERE Cell_ID = offices.cell_id LIMIT 1) as cell')
            , DB::raw('(SELECT Village FROM rwanda_geography WHERE Vill_ID = offices.village_id LIMIT 1) as village'))
            ->get();
        return view('office.parish.local-church', compact('provinces', 'localChurches'));
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
            ]);
            $region = Office::findorfail(auth()->user()->region_id)->reg_number;
            $parish = Office::findorfail(auth()->user()->parish_id)->reg_number;
            $check = Office::where('name', $request->name)->where('parish_number', $parish)->first();
            if ($check) {
                return redirect()->back()->with('error', 'Local church already exists.');
            }
            $reg = str_pad(Office::where('parish_number', $parish)->count() + 1, 2, '0', STR_PAD_LEFT);
            Office::create([
                'province_id' => $request->province,
                'district_id' => $request->district,
                'sector_id' => $request->sector,
                'cell_id' => $request->cell,
                'village_id' => $request->village,
                'name' => $request->name,
                'type' => 'local-church',
                'region_number' => $region,
                'reg_number' => $parish . $reg,
                'parish_number' => $parish,
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
