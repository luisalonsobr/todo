<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\AdminRegister;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AdminRegisterTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AdminRegister::class)
            ->assertStatus(200);
    }
}
