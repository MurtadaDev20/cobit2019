<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'mainp_id'
    ];

    public function mainProccess()
    {
        return $this->belongsTo(MainProccess::class,'mainp_id');
    }

    public function folders()
    {
        return $this->hasMany(Folder::class,'subp_id');
    }


}
