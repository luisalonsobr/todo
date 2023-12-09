<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Models\Task as ModelsTask;
use App\Models\User;
use Livewire\Component;

class Task extends Component
{
    public $task;
    public $users;
    public $userSearch;
    public $searchResults;

    public function mount($task)
    {
        $task = ModelsTask::with('users')->find($task->id);
        $this->task = $task;
        $this->users = $task->users;
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

    public function deleteTask($taskId) {
        $task = ModelsTask::find($taskId);
        $task->delete();
        $this->dispatch('task-updated', $taskId)->to(TaskListEdit::class);
    }


    public function updateduserSearch($value){
        if (!$value) {
            $this->resetErrorBag();
            $this->resetValidation();
            return;
        }

        $this->searchResults = null;

        $this->validate([
            'userSearch' => 'required|email|max:36',
        ]);

        //search users by email like
        $taskId = $this->task->id;
        $this->searchResults = User::where('email', 'like', '%' . $value . '%')
        ->whereDoesntHave('tasks', function ($query) use ($taskId) {
            $query->where('tasks.id', $taskId);
        })->get();
    }

    public function addUserToTask($taskId, $userId) {
        $task = ModelsTask::find($taskId);

        if ($task) {
            // Attach the user to the task
            $task->users()->attach($userId);

            // Optional: return some kind of response or confirmation
            $task = ModelsTask::with('users')->find($taskId);
            $this->users = $task->users;
            $this->dispatch('user-added', $taskId);
            return "User added to task successfully.";

        }

        // Optional: handle the case where the task doesn't exist
        return "Task not found.";
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
