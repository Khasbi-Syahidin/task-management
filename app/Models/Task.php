<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'is_success',
        'due_date',
        'priority',
    ];


    protected $casts = [
        'is_success' => 'boolean'
    ];


    public function category()
    {
        return $this->belongsTo(CategoryTask::class);
    }

    public static function queryBase($is_success = null, $filterDate = null, $category_id = null, $perPage = 10)
    {
        return static::select('id', 'title', 'priority', 'category_id', 'is_success', 'due_date', 'created_at')
            ->when($is_success !== null, fn($query) => $query->where('is_success', $is_success))
            ->when(
                $filterDate !== null && filled($filterDate['start']) && filled($filterDate['end']),
                function ($query) use ($filterDate) {
                    $query->whereBetween('due_date', [$filterDate['start'], $filterDate['end']]);
                }
            )
            ->when(
                $category_id !== null,
                fn($query) => $query->where('category_id', $category_id)
            )
            ->with('category')
            ->latest('created_at')
            ->paginate($perPage);
    }
}
