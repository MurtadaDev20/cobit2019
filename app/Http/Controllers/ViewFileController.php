<?php

namespace App\Http\Controllers;

use App\Models\Attach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewFileController extends Controller
{
    public function view($file)
    {
        try {
            $data = Attach::find($file);
            $path = Storage::url($data->file_path);
            //  dd($path);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'File not found'], 404);
        }

        return view('layouts.admin.viewFile', ['path' => $path]);
    }
}
