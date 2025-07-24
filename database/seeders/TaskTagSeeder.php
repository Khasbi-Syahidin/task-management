<?php

namespace Database\Seeders;

use App\Models\TaskTag;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $tags = [
            'Bug Fix',
            'Feature',
            'Improvement',
            'Documentation',
            'Testing'
        ];

        foreach ($tags as $tag) {
            TaskTag::create([
                'name' => $tag
            ]);
        }
    }
}
