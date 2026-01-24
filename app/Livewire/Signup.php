<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Signup extends Component
{
    #[Validate(['email' => 'required|email|unique:users,email'])]
    public $email;
    #[Validate(['password' => 'required|min:6'])]
    public $password;

    public function signup()
    {
        $this->validate();

        $user = User::create([
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        session()->regenerate();
        Auth::login($user);

        return redirect()->route('admin.index');
    }

    public function render()
    {
        return view('livewire.signup');
    }
}
