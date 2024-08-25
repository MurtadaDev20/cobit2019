<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attach extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'file_path' , 'folder_id','subp_id'];

    public function folder()
    {
        return $this->belongsTo(Folder::class,'folder_id');
    }

   
}
