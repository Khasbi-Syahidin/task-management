<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTask extends Model
{
    protected $table = 'category_tasks';
    protected $fillable = ['name'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'category_id');
    }
}
