<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TaskList;
use Livewire\Component;
use Livewire\Attributes\On;

class TaskListEdit extends Component
{

    public $taskId;
    public $taskTitle;
    public $taskListId;
    public $taskList;
    public $pending;
    public $done;
    public $sortBy = 'title';

    public function mount($id)
    {


        $this->taskListId = $id;
        $this->taskList = $this->getList();
        $this->pending = [];
        $this->done = [];
    }

    public function addTask()
    {
        $this->validate([
            'taskTitle' => 'required|min:3',
        ]);

        $taskList = TaskList::find($this->taskListId);
        $taskList->tasks()->create([
            'title' => $this->taskTitle,
        ]);

        $this->taskTitle = '';
    }

    public function sortedTasks($tasks)
    {
        return $this->orderBy('status')
                    ->orderBy('priority')
                    ->orderBy('title')
                    ->get();
    }


    public function getList()
    {
        $list = TaskList::with(['users.tasks' => function($query) {
            $query->orderBy('tasks.status')
                  ->orderBy('tasks.priority')
                  ->orderBy('tasks.title');
        }])->find($this->taskListId);
        return $list;
    }


    #[On('task-updated')]
    public function updated() {
        $this->taskList = $this->getList();
    }

    public function render()
    {
        return view('livewire.task-list-edit');
    }
}
