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
}
