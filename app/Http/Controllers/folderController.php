<?php

namespace App\Http\Controllers;

use App\Models\SubProccess;
use Illuminate\Http\Request;

class folderController extends Controller
{
    public function show(SubProccess $SubProcess)
        {
            return view('layouts.admin.folder', ['id' => $SubProcess->id]);
        }
}
