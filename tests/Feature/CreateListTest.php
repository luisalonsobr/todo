<?php

namespace Tests\Feature;

use App\Http\Controllers\TaskListController;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class CreateListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_list(): void
        {
            $user = User::factory()->create();
    Auth::shouldReceive('user')->andReturn($user);

    // Instantiate the controller
    $controller = new TaskListController();

    // Call the create method
    $response = $controller->create();

    // Assert a new TaskList was created and attached to the user
    $this->assertDatabaseHas('task_lists', [
        'title' => 'Lista 1' // or whatever title logic you have
    ]);

    // Assert the TaskList is attached to the user
    $this->assertEquals(1, $user->lists->count());

    // Assert the method returns a redirect response
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals(route('task-lists.edit', TaskList::latest('id')->first()), $response->headers->get('Location'));
    }
}
