<?php

namespace App\Livewire;

use App\Models\TaskList;
use Livewire\Component;

class TaskListsIndex extends Component
{
    public $lists, $view, $total;

    function mount () {
        $this->lists = TaskList::all();
        $this->total = TaskList::all()->count();
        $this->view = 'grid';
        }


    public function render()
    {
        return view('livewire.lists-list');
    }
}
