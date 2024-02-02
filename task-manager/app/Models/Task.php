<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'is_done' => 'boolean'
    ];

    protected $fillable = [
        'title',
        'body',
        'is_done',
        'user_id'
    ];
}
