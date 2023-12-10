<?php

namespace App\Livewire;

use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskListsIndex extends Component
{
    public $lists, $view, $total;

    function mount () {
        $user = Auth::user();
        $this->lists = TaskList::whereHas('users', function ($query) use ($user) {
            // Lists directly attached to the user
            $query->where('users.id', $user->id);
        })->orWhereHas('tasks', function ($query) use ($user) {
            // Lists that are not directly attached to the user
            // but have tasks attached to the user
            $query->whereHas('users', function ($subQuery) use ($user) {
                $subQuery->where('users.id', $user->id);
            });
        })->with('users')->get();
        // $this->lists = Auth::user()->lists()->with('users')->get();
        $this->total = $this->lists->count();
        $this->view = 'grid';
    }


    public function render()
    {
        return view('livewire.task-lists-index',[
            'lists' => $this->lists,
            'total' => $this->total,
            'view' => $this->view,
        ]);
    }
}
