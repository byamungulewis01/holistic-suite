<?php

namespace App\Http\Controllers\Region;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    //members
    public function members()
    {
        $members = Member::where('region_id', auth()->user()->region_id)->groupBy('parish_id')->select('members.*'
            , DB::raw('count(*) as countMember')
            , DB::raw('(SELECT count(*) FROM childrens WHERE parish_id = members.parish_id) as countChildren')
            , DB::raw('(SELECT count(*) FROM teenagers WHERE parish_id = members.parish_id) as countTeenagers')
            , DB::raw('(SELECT count(*) FROM friends WHERE parish_id = members.parish_id) as countFriends')
        )->get();
        return view('reports.region.members', compact('members'));
    }
    public function genderAndAge()
    {

        $member12And17 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(17)->format('Y-m-d'), now()->subYears(12)->format('Y-m-d')])->get();
        $member18And24 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(24)->format('Y-m-d'), now()->subYears(18)->format('Y-m-d')])->get();
        $member25And30 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(30)->format('Y-m-d'), now()->subYears(25)->format('Y-m-d')])->get();
        $member31And40 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(40)->format('Y-m-d'), now()->subYears(31)->format('Y-m-d')])->get();
        $member41And50 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(50)->format('Y-m-d'), now()->subYears(41)->format('Y-m-d')])->get();
        $memberAbove50 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') < ?", [now()->subYears(51)->format('Y-m-d')])->get();

        $parishes = Member::where('region_id', auth()->user()->region_id)->groupBy('parish_id')->get();

        return view('reports.region.genderAndAge', compact(
            'parishes', 'member12And17', 'member18And24', 'member25And30', 'member31And40', 'member41And50', 'memberAbove50'
        ));
    }
    //educationLevel
    public function educationLevel()
    {
        $parishes = Member::where('region_id', auth()->user()->region_id)->groupBy('parish_id')->get();
        $education = Member::where('region_id', auth()->user()->region_id)->groupBy('education_id')->get();
        $educations = Member::where('region_id', auth()->user()->region_id)->get();
        return view('reports.region.educationLevel', compact('parishes', 'education', 'educations'));
    }
    //socialSecurity
    public function socialSecurity()
    {
        $parishes = Member::where('region_id', auth()->user()->region_id)->groupBy('parish_id')->get();
        $socialSecurity = Member::where('region_id', auth()->user()->region_id)->groupBy('insurance_id')->get();
        $socialSecurities = Member::where('region_id', auth()->user()->region_id)->get();
        return view('reports.region.socialSecurity', compact('parishes', 'socialSecurity', 'socialSecurities'));
    }
    //savingType
    public function savingType()
    {
        $parishes = Member::where('region_id', auth()->user()->region_id)->groupBy('parish_id')->get();
        $savingType = Member::where('region_id', auth()->user()->region_id)->groupBy('saving_id')->get();
        $savingTypes = Member::where('region_id', auth()->user()->region_id)->get();
        return view('reports.region.savingType', compact('parishes','savingType','savingTypes'));
    }
}
