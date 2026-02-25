<?php

namespace App\Livewire\Employee;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.employee.dashboard')
        ->layout('layouts.employee.employee', [
            'title' => 'Dashboard',
            'subtitle' => 'Bem-vindo ao seu dashboard'
        ]);
    }
}
