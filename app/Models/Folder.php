<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'note',
        'subp_id'
    ];

    public function attach()
    {
        return $this->hasMany(Attach::class, 'folder_id');
    }

    public function subProccess()
    {
        return $this->belongsTo(SubProccess::class,'subp_id');
    }
}
