<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class getDataRateController extends Controller
{
    public function index()
    {
        $subProccesses = \App\Models\SubProccess::all();  // Fetch subProccess data
        return view('layouts.dashboard', compact('subProccesses'));
    }
}
