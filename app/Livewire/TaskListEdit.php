<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class TaskListEdit extends Component
{

    public $taskId;
    public $listTitle;
    public $taskTitle ='';
    public $description;
    public $taskListId;
    public $taskList;
    public $pending;
    public $done;
    public $percentageDone = 0;
    public $orderBy = 'status';
    public $sortDirection = 'asc'; // Sort direction
    public $filterUser;
    public $filterStatus;
    public $filterTrashed = false;
    public $filterOwner;
    public $filterTitle;
    public $filterPriority;


    public function mount($id)
    {
        $this->taskListId = $id;
        $this->taskList = $this->getList();
        $this->pending = [];
        $this->listTitle = $this->taskList->title;
        $this->done = [];
        $this->updatePercentageDone();


    }

    public function addTask()
    {
        $this->validate([
            'taskTitle' => 'required|min:3',
            'description' => 'sometimes|nullable|min:3',
        ]);

        $taskList = TaskList::find($this->taskListId);

        $task = $taskList->tasks()->create([
            'title' => $this->taskTitle,
            'description' => $this->description,
        ]);

        $user = Auth::user();
        $user->tasks()->attach($task->id);


        $this->taskTitle = '';
        $this->description = '';
        $this->taskList = $this->getList();
        $this->updatePercentageDone();
        $this->render();


    }

    function changeOrder ($order)  {
        $this->orderBy = $order;
        $this->taskList = $this->getList();
        $this->render();
    }

    public function getList()
    {
        $list = TaskList::with(['users.tasks'])->find($this->taskListId);

        switch ($this->orderBy) {
            case 'titleAz':
                $list->tasks = $list->tasks->sortBy(function ($task) {
                    return strtolower($task->title);
                });
                break;

            case 'titleZa':
                $list->tasks = $list->tasks->sortByDesc(function ($task) {
                    return strtolower($task->title);
                });
                break;

                case 'priority':
                    $list->tasks = $list->tasks->sort(function ($a, $b) {
                        if ($a->priority === $b->priority) {
                            // Compare titles in a case-insensitive manner
                            $titleComparison = strcasecmp($a->title, $b->title);
                            if ($titleComparison !== 0) {
                                return $titleComparison;
                            }
                            // If titles are the same, compare status
                            return strcmp($a->status, $b->status);
                        }
                        // Compare priority
                        return $a->priority <=> $b->priority;
                    });
                    break;

            default:
                $list->tasks = $list->tasks->sort(function ($a, $b) {
                    $compStatus = strcasecmp($a->status, $b->status);
                    if ($compStatus !== 0) {
                        return $compStatus;
                    }

                    $compPriority = strcasecmp($a->priority, $b->priority);
                    if ($compPriority !== 0) {
                        return $compPriority;
                    }

                    return strcasecmp($a->title, $b->title);
                });
                break;
        }

        return $list;
    }


    #[On('task-updated')]
    public function updated() {
        $this->taskList = $this->getList();
        $this->updatePercentageDone();
        $this->render();

    }

    public function updatedListTitle($value){
    $this->validate([
        'listTitle' => 'required|string|max:36',
    ]);

    $taskList = TaskList::find($this->taskListId);
    $taskList->title = $value;
    $taskList->save();

    // Further processing...
}
    public function updatePercentageDone()
{
    // Calculate the percentage of tasks done
    $totalTasks = count($this->taskList->tasks);
    $tasksDone = count($this->taskList->tasks->filter(function ($task) {
        return $task->status == true;
    }));

    $percentageDone = 0;
    if ($totalTasks > 0) {
        $percentageDone = ($tasksDone / $totalTasks) * 100;
    }

    // Add the percentage to the list object or return it separately
    //cealing:

    $this->percentageDone = ceil($percentageDone);
    $this->render();
    if ($this->percentageDone == 100) {
        $this->dispatch('event-name');
    }
    return $percentageDone;

}

    public function render()
    {
        return view('livewire.task-list-edit');
    }
}
