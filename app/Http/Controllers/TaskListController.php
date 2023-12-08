<?php

namespace App\Http\Controllers;

use App\Models\ListPivot;
use App\Models\TaskList;
use App\Models\TaskPivot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('lists.tasks')->find(Auth::user()->id);

        return view('livewire.task-lists-index', [
            'lists' => $user->lists,
            'total' => $user->lists->count(),
            'view' => Auth::user()->preferences ? Auth::user()->preferences->mode : 'grid',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $userId = $user->id;
        $total = TaskList::whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->count();
        $taskList = new TaskList();
        $taskList->title = 'Lista ' . ($total + 1);
        $taskList->save();

        $user->lists()->attach($taskList->id);

        return redirect()->route('task-lists.edit', $taskList);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskList $taskList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function wireEdit(TaskList $taskList)
    {
        return \App\Livewire\TaskListEdit::class;

        $list = TaskList::with(['users.tasks'])->find($taskList->id);

        return view('livewire.task-list-edit', [
            'taskList' => $list,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskList $taskList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskList $taskList)
    {
        //
    }
}
