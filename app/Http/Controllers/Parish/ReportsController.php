<?php

namespace App\Http\Controllers\Parish;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    //members
    public function members()
    {
        $members = Member::where('parish_id', auth()->user()->parish_id)->groupBy('local_church_id')->select('members.*'
            , DB::raw('count(*) as countMember')
            , DB::raw('(SELECT count(*) FROM childrens WHERE local_church_id = members.local_church_id) as countChildren')
            , DB::raw('(SELECT count(*) FROM teenagers WHERE local_church_id = members.local_church_id) as countTeenagers')
            , DB::raw('(SELECT count(*) FROM friends WHERE local_church_id = members.local_church_id) as countFriends')
        )->get();
        return view('reports.parish.members', compact('members'));
    }
    public function genderAndAge()
    {

        $member12And17 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(17)->format('Y-m-d'), now()->subYears(12)->format('Y-m-d')])->get();
        $member18And24 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(24)->format('Y-m-d'), now()->subYears(18)->format('Y-m-d')])->get();
        $member25And30 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(30)->format('Y-m-d'), now()->subYears(25)->format('Y-m-d')])->get();
        $member31And40 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(40)->format('Y-m-d'), now()->subYears(31)->format('Y-m-d')])->get();
        $member41And50 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') BETWEEN ? AND ?", [now()->subYears(50)->format('Y-m-d'), now()->subYears(41)->format('Y-m-d')])->get();
        $memberAbove50 = Member::whereRaw("STR_TO_DATE(dateOfBirth, '%m/%d/%Y') < ?", [now()->subYears(51)->format('Y-m-d')])->get();

        $churches = Member::where('parish_id', auth()->user()->parish_id)->groupBy('local_church_id')->get();

        return view('reports.parish.genderAndAge', compact(
            'churches', 'member12And17', 'member18And24', 'member25And30', 'member31And40', 'member41And50', 'memberAbove50'
        ));
    }
    //educationLevel
    public function educationLevel()
    {
        $churches = Member::where('parish_id', auth()->user()->parish_id)->groupBy('local_church_id')->get();
        $education = Member::where('parish_id', auth()->user()->parish_id)->groupBy('education_id')->get();
        $educations = Member::where('parish_id', auth()->user()->parish_id)->get();
        return view('reports.parish.educationLevel', compact('churches', 'education', 'educations'));
    }
    //socialSecurity
    public function socialSecurity()
    {
        $churches = Member::where('parish_id', auth()->user()->parish_id)->groupBy('local_church_id')->get();
        $socialSecurity = Member::where('parish_id', auth()->user()->parish_id)->groupBy('insurance_id')->get();
        $socialSecurities = Member::where('parish_id', auth()->user()->parish_id)->get();
        return view('reports.parish.socialSecurity', compact('churches', 'socialSecurity', 'socialSecurities'));
    }
    //savingType
    public function savingType()
    {
        $churches = Member::where('parish_id', auth()->user()->parish_id)->groupBy('local_church_id')->get();
        $savingType = Member::where('parish_id', auth()->user()->parish_id)->groupBy('saving_id')->get();
        $savingTypes = Member::where('parish_id', auth()->user()->parish_id)->get();
        return view('reports.parish.savingType', compact('churches','savingType','savingTypes'));
    }
}
