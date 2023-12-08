<?php

namespace App\Livewire;

use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskListsIndex extends Component
{
    public $lists, $view, $total;

    function mount () {
        $this->lists = Auth::user()->lists()->with('users')->get();
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
