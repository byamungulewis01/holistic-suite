<?php

namespace App\Http\Controllers\Member;

use App\Models\Family;
use App\Models\Member;
use App\Models\Office;
use App\Models\MemberStep;
use App\Models\ClassMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //profile
    public function profile()
    {
        $id = auth()->guard('member')->user()->member_id;
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
        return view('frontend.member.profile', compact('member', 'regions', 'childPrayer', 'baptism', 'marriage', 'families','classes'));
    }
    // home
    public function home()
    {
        return view('frontend.home');
    }
}
