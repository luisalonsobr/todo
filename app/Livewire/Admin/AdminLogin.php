<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLogin extends Component
{
    public $email = '';
    public $password = '';

    public function render()
    {
        return view('livewire.admin.admin-login')
        ->layout('layouts.guest');
    }

    public function post()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            session()->regenerate();

            if (session()->has('url.intended')) {
                return redirect()->intended(session()->get('url.intended'));
            }

            return redirect()->route('admin.dashboard');
        } else {
            $this->addError('email', 'E-mail e/ou senha inválidos.');
            return;
        }
    }


}
