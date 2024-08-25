<?php

namespace App\Http\Controllers;

use App\Models\MainProccess;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function show(MainProccess $process)
{
    return view('layouts.admin.subProccess', ['id' => $process->id]);
}
}
