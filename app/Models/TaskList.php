<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = ['title', 'color'];

    protected $table = 'task_lists'; // Specify the custom table name

    public function users()
    {
        return $this->belongsToMany(User::class, 'list_pivots');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_list_id'); // ForeignKey in Task model
    }
}
