<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',   // Allow mass assignment of user_id
        'supP_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function SubProccess()
    {
        return $this->belongsTo(SubProccess::class);
    }
}
