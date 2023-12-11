<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Livewire\Component;

class AdminRegister extends Component
{
    public function post()
    {
        $input = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ]);


        return Admin::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

    }

    public function render()
    {
        return view('livewire.admin.admin-register')
        ->layout('layouts.guest');
    }
}
