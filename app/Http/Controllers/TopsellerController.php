<?php

namespace App\Http\Controllers;
use App\Models\Topseller;

use Illuminate\Http\Request;

class TopsellerController extends Controller
{
    public function showTopSeller(){
        $topSellers = Topseller::latest()->take(10)->get();
       return view('topsellers', compact('topSellers'));
    }
}
