<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            ['project_name' => 'Project 1','status' => 'active','created_at' => now(),'updated_at' => now()],
            ['project_name' => 'Project 2','status' => 'inactive','created_at' => now(),'updated_at' => now()],
            ['project_name' => 'Project 3','status' => 'active','created_at' => now(),'updated_at' => now()],
            ['project_name' => 'Project 4','status' => 'active','created_at' => now(),'updated_at' => now()],
            ['project_name' => 'Project 5','status' => 'active','created_at' => now(),'updated_at' => now()]
        ];

        foreach($projects as $project){
            Project::create($project);
        }
    }
}
