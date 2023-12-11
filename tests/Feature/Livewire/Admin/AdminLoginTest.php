<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\AdminLogin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AdminLogin::class)
            ->assertStatus(200);
    }
}
