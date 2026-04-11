<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use App\Models\Employee\Availability as EmployeeAvailability;
use App\Rules\RoundedTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Availability extends Component
{
    #[Validate('required|integer|between:0,6')]
    public $weekday;

    #[Validate(['required', 'date_format:H:i', new RoundedTime])]
    public $time;

    #[Validate('required|boolean')]
    public $active;

    public $showModal;

    public $editModal;

    #[Validate('required|exists:employees,id')]
    public $employeeId;

    public $availabilities;

    public $arrayWeekday = [
        0 => 'domingo',
        1 => 'segunda-feira',
        2 => 'terça-feira',
        3 => 'quarta-feira',
        4 => 'quinta-feira',
        5 => 'sexta-feira',
        6 => 'sábado'
    ];

    public function mount()
    {
        $this->weekday = 0;
        $this->active = true;
    }

    protected function rules()
    {
        return [
            'time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $minute = (int) explode(':', $value)[1];

                    if ($minute % 30 !== 0) {
                        $fail('The time must be in 30-minute intervals.');
                    }
                },
            ],
        ];
    }

    public function create()
    {
        $this->showModal = true;
    }

    public function save()
    {
        $user = Auth::id();
        $employeeId = Employee::where('user_id', $user)->value('id');

        if (!$employeeId) {
            $this->addError('general', 'Funcionário não encontrado.');
            return;
        }

        $this->employeeId = $employeeId;

        $exists = EmployeeAvailability::where('employee_id', $this->employeeId)
            ->where('weekday', $this->weekday)
            ->where('time', $this->time)
            ->exists();

        if ($exists) {
            $this->addError('time', 'Este horário já existe para este dia.');
            return;
        }

        $this->validate();

        $this->showModal = false;

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

    public function delete($id)
    {
        EmployeeAvailability::destroy($id);
    }

    public function toggleActive($id)
    {
        $this->active = true;

        $isActive = EmployeeAvailability::where('id', $id)->value('active');
        if($isActive)
            $this->active = false;

        EmployeeAvailability::where('id', $id)->update([
            'active' => $this->active,
        ]);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editModal = false;
    }

    public function openEditModal($weekday)
    {
        $this->weekday = $weekday;
        $this->editModal = true;
    }

    public function render()
    {
        $user = Auth::id();
        $employeeId = Employee::where('user_id', $user)->value('id');

        if (!$employeeId) {
            // Se o usuário não for um funcionário, retorna array vazio
            return view('livewire.employee.availability', [
                'availabilities' => []
            ])->layout('layouts.employee.employee', [
                'title' => 'Disponibilidade',
                'subtitle' => 'Gerenciar sua disponibilidade'
            ]);
        }

        $this->employeeId = $employeeId;

        $availabilities = $this->availabilities = EmployeeAvailability::where('employee_id', $this->employeeId)
                ->orderBy('weekday')
                ->orderByDesc('active')
                ->orderBy('time')
                ->get()
                ->groupBy('weekday')
                ->toArray();

        return view('livewire.employee.availability', compact('availabilities'))
        ->layout('layouts.employee.employee', [
            'title' => 'Disponibilidade',
            'subtitle' => 'Gerenciar sua disponibilidade'
        ]);
    }
}
