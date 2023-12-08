<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = ['title', 'description', 'due_at', 'status'];

    public function taskList()
    {
        return $this->belongsTo(TaskList::class, 'task_list_id'); // ForeignKey in this model
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
