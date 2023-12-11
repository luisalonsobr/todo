<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TaskListsIndex;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use Tests\TestCase;

class TaskListIndexTest extends TestCase
{
    use RefreshDatabase;

    public function teste_task_list_index(): void
    {
    // Arrange
    // Create a user and associated task lists
    $user = User::factory()->create();
    // Add code to create TaskLists and associate them with the user

    // Act
    // Mimic the user being logged in
    $this->actingAs($user);

    // Render the Livewire component
    $component = Livewire::test(TaskListsIndex::class);

    // Assert
    // Check if the component's lists property contains the expected data
    $component->assertViewHas('lists', function($lists) use ($user) {
        // Add assertions based on your requirements
        // For example, check if the lists belong to the user
        return true; // Replace with actual assertion
    });
    }
}
