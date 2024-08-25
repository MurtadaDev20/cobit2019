<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class fileController extends Controller
{
    
    public function show(Folder $folder)
        {
            return view('layouts.admin.file', ['id' => $folder->id]);
        }
}
