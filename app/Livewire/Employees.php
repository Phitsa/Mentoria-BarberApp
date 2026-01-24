<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;
    public $showModal;
    public $isEditing;
    public $isDeleting;
    public $id;
    public $name;
    public $tax_id;
    public $phone;
    public $birth_date;
    public $active = false;
    public function create()
    {
        $this->reset('name','tax_id', 'phone', 'birth_date', 'active',);
        $this->isDeleting = false;
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        $this->id = $employee->id;
        $this->name = $employee->name;
        $this->phone = $employee->phone;
        $this->tax_id = $employee->tax_id;
        $this->active = $employee->active;
        $this->birth_date = $employee->birh_date;

        $this->isDeleting = false;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->isEditing){
            Employee::findOrFail($this->id)->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'tax_id' => $this->tax_id,
                'active' => $this->active,
                'birth_date' => $this->birth_date,
            ]);
        } else {
            Employee::query()->create([
                'name' => $this->name,
                'phone' => $this->phone,
                'tax_id' => $this->tax_id,
                'active' => $this->active,
                'birth_date' => $this->birth_date,
            ]);
        }
        $this->reset('name','tax_id', 'phone', 'birth_date', 'active',);
        $this->showModal = false;
    }

    public function closeModal()
    {
        $this->isDeleting = false;
        $this->isEditing = false;
        $this->showModal = false;
    }
    public function render()
    {
        $employees = Employee::paginate(10);
        return view('livewire.employees', compact('employees'));
    }
}
