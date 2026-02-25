<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate(['email' => 'required|email|'])]
    public $email;
    #[Validate(['password' => 'required|min:6'])]
    public $password;

    public function login()
    {
        $credentials = $this->validate();
        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->route('admin.index');
        }
        $this->addError('credentials', 'Credenciais inválidas.');

    }
    public function render()
    {
        return view('livewire.admin.login')
        ->layout('layouts.auth.auth');
    }
}
