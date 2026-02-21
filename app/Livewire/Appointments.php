<?php

namespace App\Livewire;

use Livewire\Component;

class Appointments extends Component
{
    public $showModal;
    public $isEditing;
    public $isDeleting;
    public $id;
    public $customerId;
    public $employeeId;
    public $scheduledAt;
    public $status;

    public function render()
    {
        return view('livewire.appointments')
        ->layout('layouts.admin.admin', [
            'title' => 'Agendamentos',
            'subtitle' => 'Gerencie seus agendamentos'
        ]);
    }
}
