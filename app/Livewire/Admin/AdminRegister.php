<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminRegister extends Component
{

    public $name = "";
    public $email = "";
    public $password = "";
    public $password_confirmation = "";

    public function post()
    {
        $input = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Admin::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        session()->flash('status', 'Administrador criado.');
        $this->redirect(AdminLogin::class);
        return;

    }

    public function render()
    {
        return view('livewire.admin.admin-register')
        ->layout('layouts.guest');
    }
}
