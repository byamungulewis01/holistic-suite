<?php

namespace App\Http\Controllers\LocalChurch;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    //members
    public function members()
    {
        $members = Member::where('local_church_id', auth()->user()->local_church_id)->groupBy('sector_id')->select('members.*'
            , DB::raw('(SELECT Sector FROM rwanda_geography WHERE Sect_ID = members.sector_id LIMIT 1) as sector')
            , DB::raw('count(*) as countMember')
            , DB::raw('(SELECT count(*) FROM childrens WHERE sector_id = members.sector_id) as countChildren')
            , DB::raw('(SELECT count(*) FROM teenagers WHERE sector_id = members.sector_id) as countTeenagers')
            , DB::raw('(SELECT count(*) FROM friends WHERE sector_id = members.sector_id) as countFriends')
        )->get();
        return view('reports.localChurch.members', compact('members'));
    }
    //genderAndAge
    public function genderAndAge()
    {

        $member12And17 = Member::where('local_church_id', auth()->user()->local_church_id)->whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(17)->format('Y-m-d'), now()->subYears(12)->format('Y-m-d')])->get();
        $member18And24 = Member::where('local_church_id', auth()->user()->local_church_id)->whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(24)->format('Y-m-d'), now()->subYears(18)->format('Y-m-d')])->get();
        $member25And30 = Member::where('local_church_id', auth()->user()->local_church_id)->whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(30)->format('Y-m-d'), now()->subYears(25)->format('Y-m-d')])->get();
        $member31And40 = Member::where('local_church_id', auth()->user()->local_church_id)->whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(40)->format('Y-m-d'), now()->subYears(31)->format('Y-m-d')])->get();
        $member41And50 = Member::where('local_church_id', auth()->user()->local_church_id)->whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(50)->format('Y-m-d'), now()->subYears(41)->format('Y-m-d')])->get();
        $memberAbove50 = Member::where('local_church_id', auth()->user()->local_church_id)->whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') < ?", [now()->subYears(51)->format('Y-m-d')])->get();
        return view('reports.localChurch.genderAndAge', compact(
            'member12And17', 'member18And24', 'member25And30', 'member31And40', 'member41And50', 'memberAbove50'
        ));
    }
    //educationLevel
    public function educationLevel()
    {
        $members = Member::selectRaw('education_id, SUM(CASE WHEN gender = 1 THEN 1 ELSE 0 END) as totalMale, SUM(CASE WHEN gender = 2 THEN 1 ELSE 0 END) as totalFemal, COUNT(*) as totalCount')->
            where('local_church_id', auth()->user()->local_church_id)->groupBy('education_id')->get();
        return view('reports.localChurch.educationLevel', compact('members'));
    }
    //socialSecurity
    public function socialSecurity()
    {
        $members = Member::selectRaw('insurance_id, SUM(CASE WHEN gender = 1 THEN 1 ELSE 0 END) as totalMale, SUM(CASE WHEN gender = 2 THEN 1 ELSE 0 END) as totalFemal, COUNT(*) as totalCount')->
            where('local_church_id', auth()->user()->local_church_id)->groupBy('insurance_id')->get();
        return view('reports.localChurch.socialSecurity', compact('members'));
    }
    //savingType
    public function savingType()
    {
        $members = Member::selectRaw('saving_id, SUM(CASE WHEN gender = 1 THEN 1 ELSE 0 END) as totalMale, SUM(CASE WHEN gender = 2 THEN 1 ELSE 0 END) as totalFemal, COUNT(*) as totalCount')->
            where('local_church_id', auth()->user()->local_church_id)->groupBy('saving_id')->get();
        return view('reports.localChurch.savingType', compact('members'));
    }
}
