<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use App\Models\Employee\Availability as EmployeeAvailability;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Availability extends Component
{
    #[Validate('required|integer|between:0,6')]
    public $weekday;

    #[Validate('required|date_format:H:i')]
    public $time;

    #[Validate('required|boolean')]
    public $active;

    public $showModal;

    #[Validate('required|exists:employees,id')]
    public $employeeId;

    public function mount()
    {
        $employee = Employee::where('user_id', Auth::id())->first();

        $this->employeeId = $employee?->id;
        $this->weekday = 0;
        $this->active = true;
    }

    public function create()
    {
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        EmployeeAvailability::create([
            'employee_id' => $this->employeeId,
            'weekday' => $this->weekday,
            'time' => $this->time,
            'active' => $this->active,
        ]);

        $this->showModal = false;
        $this->reset(['weekday', 'time']);
        $this->active = true;
    }

    public function openModal($weekday) // TODO: Implement edit modal opening logic
    {
        $this->weekday = $weekday;
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.employee.availability')
        ->layout('layouts.employee.employee', [
            'title' => 'Disponibilidade',
            'subtitle' => 'Gerenciar sua disponibilidade'
        ]);
    }
}
