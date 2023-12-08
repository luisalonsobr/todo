<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Models\Task as ModelsTask;
use Livewire\Component;

class Task extends Component
{
    public $task;

    public function mount($task)
    {
        $this->task = $task;
    }

    public function render()
    {
        return view('livewire.task');
    }
    public function toggleTask($taskId) {
        $task = ModelsTask::find($taskId);
        $task->status = !$task->status;
        $task->save();
        $this->task = $task;
        $this->dispatch('task-updated', $taskId)->to(TaskListEdit::class);
    }
}
