<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ['project_id' => '1','task_name' => 'Task 1','status' => 'active','created_at' => now(),'updated_at' => now()],
            ['project_id' => '1','task_name' => 'Task 2','status' => 'active','created_at' => now(),'updated_at' => now()],
            ['project_id' => '1','task_name' => 'Task 3','status' => 'active','created_at' => now(),'updated_at' => now()],
            ['project_id' => '4','task_name' => 'Task 4','status' => 'active','created_at' => now(),'updated_at' => now()],
            ['project_id' => '4','task_name' => 'Task 5','status' => 'active','created_at' => now(),'updated_at' => now()]
        ];
        foreach($tasks as $task){
            Task::create($task);
        }
    }
}
