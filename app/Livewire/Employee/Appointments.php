<?php

namespace App\Livewire\Employee;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
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
    public $appointment;
    public $customers = [];
    public $adminId;

    public function mount()
    {
        $employee = Employee::where('user_id', Auth::id())->first();

        if (! $employee) {
            $this->customers = collect();
            return;
        }

        $this->employeeId = $employee->id;
        $this->adminId = $employee->admin_id;

        $this->customers = Customer::where('admin_id', $this->adminId)
            ->orderBy('name')
            ->get();
    }
    public function create()
    {
        $this->reset(['customerId', 'employeeId', 'scheduledAt', 'status']);
        $this->showModal = true;
        $this->isEditing = false;
        $this->isDeleting = false;
    }

    public function save()
    {
        $this->validate([
            'customerId' => ['required'],
            'scheduledAt' => ['required', 'date'],
            'status' => ['required', 'string'],
        ]);

        $this->closeModal();
        session()->flash('success', 'Disponibilidade atualizada com sucesso.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->isEditing = false;
        $this->isDeleting = false;
    }

    public function render()
    {
        return view('livewire.employee.appointments')
            ->layout('layouts.employee.employee', [
                'title' => 'Agendamentos',
                'subtitle' => 'Gerencie seus agendamentos',
            ]);
    }
}
