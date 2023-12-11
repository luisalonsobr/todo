<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\AdminLoginProcess;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AdminLoginProcessTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AdminLoginProcess::class)
            ->assertStatus(200);
    }
}
