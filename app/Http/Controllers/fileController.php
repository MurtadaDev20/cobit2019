<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\SubProccess;
use Illuminate\Http\Request;

class fileController extends Controller
{

    public function show(SubProccess $subProccess)
        {
            return view('layouts.admin.file', ['id' => $subProccess->id]);
        }
}
