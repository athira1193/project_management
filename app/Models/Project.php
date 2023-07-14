<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;
    public function task()
    {
        return $this->hasMany(Task::class);
    }
    public function tasktime()
    {
        return $this->hasMany(TimeToTask::class);
     
    }
}
