<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainProccess extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'desc'
    ];

    public function subProccess()
    {
        return $this->hasMany(SubProccess::class, 'mainp_id');
    }
}
