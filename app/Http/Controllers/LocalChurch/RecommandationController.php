<?php

namespace App\Http\Controllers\LocalChurch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recommand\TransferRequest;

class RecommandationController extends Controller
{
    public function transferList()
    {
       $transfer = TransferRequest::orderBy('created_at','desc')->get();
       return view('online-service.recommandation.transferList',compact('transfer'));
    }
    public function guterana()
    {
        return view('online-service.recommandation.guterana');
    }
    // gusabaAkazi
    public function gusabaAkazi()
    {
        return view('online-service.recommandation.gusabaAkazi');
    }

}
