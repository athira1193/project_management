<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeToTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'task_id',
        'description',
        'hours',
        'date',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
