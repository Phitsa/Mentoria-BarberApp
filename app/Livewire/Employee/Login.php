<?php

namespace App\Livewire\Employee;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate(['email' => 'required|email|'])]
    public $email;
    #[Validate(['password' => 'required|min:6'])]
    public $password;

    public function login() {

        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->route('employee.index');
        }

        $this->addError('credentials', 'Credenciais inválidas.');
    }


    public function render()
    {
        return view('livewire.employee.login')
        ->layout('layouts.auth.auth');
    }
}
