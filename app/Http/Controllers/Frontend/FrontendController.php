<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;



class FrontendController extends Controller
{
    public function index(){

        $datas = Banner::Where('status', 1)->get();
        return view('frontend.index', compact('datas'));
    }
}
