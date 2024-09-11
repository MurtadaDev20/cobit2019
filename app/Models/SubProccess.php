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
        'note',
        'rate',
        'mainp_id'
    ];

    public function mainProccess()
    {
        return $this->belongsTo(MainProccess::class,'mainp_id');
    }

    public function attach()
    {
        return $this->hasMany(Attach::class, 'subp_id');
    }


}
