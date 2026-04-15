<?php

namespace App\Livewire\Employee;

use App\Models\Customer;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Appointments extends Component
{
    public $showCalendar = false;
    public $selectedDate;
    public $weekStart;
    public $weekDays = [];
    public $availableSlots = [];
    public $mockSlots = [];

    public $showModal;
    public $isEditing;
    public $isDeleting;
    public $id;
    public $customerId;
    public $employeeId;
    public $day;
    public $time;
    public $status;
    public $appointment;
    public $customers = [];
    public $adminId;

    public function mount()
    {
        $this->initializeCalendar();
    }

    protected function initializeCalendar()
    {
        $today = Carbon::today();
        $this->selectedDate = $today->format('Y-m-d');
        $this->weekStart = $today->copy()->startOfWeek(Carbon::MONDAY);
        $this->mockSlots = $this->makeMockSlots($this->weekStart);
        $this->loadWeekDays();
        $this->loadAvailableSlots();
    }

    protected function makeMockSlots(Carbon $start)
    {
        $slots = [];

        for ($i = 0; $i < 21; $i++) {
            $date = $start->copy()->addDays($i)->format('Y-m-d');

            if ($i % 5 === 0) {
                $slots[$date] = ['09:00', '10:30', '14:00', '16:00'];
            } elseif ($i % 3 === 0) {
                $slots[$date] = ['08:30', '11:00', '13:30'];
            } else {
                $slots[$date] = ['09:30', '12:00', '15:00', '17:30'];
            }
        }

        return $slots;
    }

    protected function loadWeekDays()
    {
        $this->weekDays = [];

        for ($dayOffset = 0; $dayOffset < 7; $dayOffset++) {
            $date = Carbon::parse($this->weekStart)->copy()->addDays($dayOffset);

            $this->weekDays[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $date->format('d'),
                'label' => $this->weekdayLabel($date->format('D')),
                'monthDay' => $date->format('M'),
                'isSelected' => $date->format('Y-m-d') === $this->selectedDate,
            ];
        }
    }

    protected function weekdayLabel(string $shortWeekday): string
    {
        return match ($shortWeekday) {
            'Mon' => 'Seg',
            'Tue' => 'Ter',
            'Wed' => 'Qua',
            'Thu' => 'Qui',
            'Fri' => 'Sex',
            'Sat' => 'Sáb',
            'Sun' => 'Dom',
            default => $shortWeekday,
        };
    }

    protected function loadAvailableSlots()
    {
        $this->availableSlots = $this->mockSlots[$this->selectedDate] ?? [];
    }

    public function openCalendar()
    {
        $this->showCalendar = true;
    }

    public function closeCalendar()
    {
        $this->showCalendar = false;
    }

    public function previousWeek()
    {
        $this->weekStart = Carbon::parse($this->weekStart)->subWeek();
        $this->loadWeekDays();
    }

    public function nextWeek()
    {
        $this->weekStart = Carbon::parse($this->weekStart)->addWeek();
        $this->loadWeekDays();
    }

    public function selectDay($date)
    {
        $this->selectedDate = $date;
        $this->loadWeekDays();
        $this->loadAvailableSlots();
    }

    public function create()
    {
        $this->reset(['customerId', 'employeeId', 'day', 'time', 'status']);
        $this->openCalendar();
        $this->isEditing = false;
        $this->isDeleting = false;
    }

    public function save()
    {
        $this->validate([
            'customerId' => ['required'],
            'day' => ['required', 'date'],
            'time' => ['required'],
            'status' => ['required', 'string'],
        ]);

        $this->closeCalendar();
        session()->flash('success', 'Disponibilidade atualizada com sucesso.');
    }

    public function closeModal()
    {
        $this->closeCalendar();
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
