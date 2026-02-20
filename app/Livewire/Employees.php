<?php

namespace App\Livewire;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;
    public $showModal;
    public $isEditing;
    public $isDeleting;
    public $showInfo;
    public $selectedServices = [];
    public $selectedEmployee;
    public $selectedEmployeeId;
    public $id;
    public $adminId;
    #[Validate('required|numeric|digits:11')]
    public $tax_id;
    public $password;
    public $email;
    #[Validate('required|min:8|string')]
    public $name;
    #[Validate('required|string|min:10|max:20')]
    public $phone;
    #[Validate('required|date')]
    public $birth_date;
    #[Validate('boolean')]
    public $active = false;
    public $employee;

    public function mount()
    {
        $this->adminId = Admin::where('user_id', Auth::id())->first()->id;
    }
    public function create()
    {
        $this->reset('name','tax_id', 'phone', 'birth_date', 'active', 'password', 'email');
        $this->isDeleting = false;
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        $this->employee = $employee;
        $this->id = $employee->id;
        $this->name = $employee->name;
        $this->phone = $employee->phone;
        $this->tax_id = $employee->tax_id;
        $this->active = $employee->active;
        $this->birth_date = $employee->birth_date;
        $this->selectedServices = $employee->services->pluck('id')->toArray();
        $this->isDeleting = false;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if (!$this->isEditing) {
            $this->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ]);
        }

        if ($this->isEditing){
            Employee::findOrFail($this->id)->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'tax_id' => $this->tax_id,
                'active' => $this->active,
                'birth_date' => $this->birth_date,
            ]);
            $employee = Employee::findOrFail($this->id);

            $employee->services()->sync($this->selectedServices);
        } else {
            $user = User::create([
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
            Employee::query()->create([
                'name' => $this->name,
                'user_id' => $user->id,
                'phone' => $this->phone,
                'tax_id' => $this->tax_id,
                'active' => $this->active,
                'birth_date' => $this->birth_date,
                'joined_at' => now(),
                'admin_id' => $this->adminId

            ]);
            $employee = Employee::where('user_id', $user->id)->first();
            $employee->services()->sync($this->selectedServices);

        }
        $this->reset('name','tax_id', 'phone', 'birth_date', 'active', 'password', 'email', 'selectedServices');
        $this->showModal = false;
    }

    public function delete($id) {
        $this->employee = Employee::findOrFail($id);


        $this->isDeleting = true;
        $this->isEditing = false;
        $this->showModal = false;
        $this->showInfo = false;
    }

    public function deleteEmployee() {

        $this->employee->delete();

        $this->isDeleting = false;
        $this->isEditing = false;
        $this->showModal = false;
        $this->showInfo = false;
    }

    public function closeModal()
    {
        $this->isDeleting = false;
        $this->isEditing = false;
        $this->showModal = false;
        $this->showInfo = false;
        $this->selectedEmployeeId = null;
    }

    public function info($id)
    {
        $this->selectedEmployee = Employee::findOrFail($id);
        $this->selectedEmployeeId = $id;
        $this->resetPage('servicesPage');
        $this->showInfo = true;
    }
    public function render()
    {
        $employees = Employee::where('admin_id', $this->adminId)->paginate(10);
        $services = Service::all();

        $employeeServices = null;
        if ($this->selectedEmployeeId) {
            $employeeServices = Service::whereHas('employees', function ($query): void {
                $query->where('employee_id', $this->selectedEmployeeId);
            })->paginate(10, ['*'], 'servicesPage');
        }

        return view('livewire.employees', compact('employees', 'services', 'employeeServices'))
            ->layout('layouts.admin.admin', [
                'title' => 'Funcionários',
                'subtitle' => 'Gerencie seus funcionários'
            ]);
    }
}
