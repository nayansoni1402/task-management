<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Task::create([
                'title' => 'Task ' . $i,
                'description' => 'Description for Task ' . $i,
                'priority' => 'medium',
                'deadline' => Carbon::now()->addDays($i),
                'status' => 'pending',
                'user_id' => 1,
            ]);
        }
    }
}