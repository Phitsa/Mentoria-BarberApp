<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $url;
    public function mount()
    {
        $this->url = url()->current();
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('layouts.admin.admin', [
            'title' => 'Clientes',
            'subtitle' => 'Gerencie seus clientes'
        ]);
    }
}
