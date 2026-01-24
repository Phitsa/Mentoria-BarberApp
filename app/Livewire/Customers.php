<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;
    public $showModal;
    public $isEditing;
    public $isDeleting;
    public $id;
    public $name;
    public $tax_id;
    public $birth_date;
    public $phone;
    public $email;
    public $password;
    public function edit($id) {

        $this->id = $id;

        $customer = Customer::findOrFail($id);
        $this->name = $customer->name;
        $this->tax_id = $customer->tax_id;
        $this->birth_date = $customer->birth_date;
        $this->phone = $customer->phone;

        $this->isEditing = true;
        $this->isDeleting = false;
        $this->showModal = true;

    }

    public function create()
    {
        $this->reset('name', 'tax_id', 'birth_date', 'phone', 'email', 'password');
        $this->isEditing = false;
        $this->isDeleting = false;
        $this->showModal = true;

    }
    public function delete($id)
    {
        $this->id = $id;
        $customer = Customer::findOrFail($id);
        $this->name = $customer->name;
        $this->isDeleting = true;
        $this->isEditing = false;
        $this->showModal = false;
    }

    public function confirmDelete()
    {
        Customer::findOrFail($this->id)->delete();
        User::findOrFail($this->id)->delete();

        $this->isDeleting = false;
        $this->isEditing = false;
        $this->showModal = false;
    }

    public function save()
    {
        if ($this->isEditing) {
            $this->validate([
                'name' => 'required|string|min:3|max:255',
                'tax_id' => 'required|digits:11|unique:customers,tax_id,' . $this->id,
                'birth_date' => 'required|date|before:today',
                'phone' => 'required|numeric|digits:11',
            ]);
            Customer::findOrFail($this->id)->update([
                'name' => $this->name,
                'tax_id' => $this->tax_id,
                'birth_date' => $this->birth_date,
                'phone' => $this->phone,
            ]);
        } else {
            $this->validate([
                'name' => 'required|string|min:3|max:255',
                'tax_id' => 'required|digits:11|unique:customers,tax_id',
                'birth_date' => 'required|date|before:today',
                'phone' => 'required|numeric|digits:11',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
            Customer::create([
                'name' => $this->name,
                'user_id' => $user->id,
                'tax_id' => $this->tax_id,
                'birth_date' => $this->birth_date,
                'phone' => $this->phone,
            ]);
        }
        $this->reset('name', 'tax_id', 'birth_date', 'phone', 'email', 'password');
        $this->isEditing = false;
        $this->showModal = false;
        $this->isDeleting = false;
    }

    public function closeModal()
    {
        $this->isEditing = false;
        $this->showModal = false;
        $this->isDeleting = false;
        $this->resetErrorBag();
    }
    public function render()
    {
        $customers = Customer::paginate(10);
        return view('livewire.customers', compact('customers'));
    }
}
