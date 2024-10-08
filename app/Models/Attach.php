<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attach extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'file_path' , 'subp_id'];


    public function subProccess()
    {
        return $this->belongsTo(SubProccess::class,'subp_id');
    }


}
