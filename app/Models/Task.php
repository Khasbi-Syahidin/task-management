<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'content',
        'category',
        'status',
        'tag_id',
    ];


    public function tag()
    {
        return $this->belongsTo(TaskTag::class);
    }
}
