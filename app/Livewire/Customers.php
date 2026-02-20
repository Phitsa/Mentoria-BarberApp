<?php

namespace App\Livewire;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    public $adminId;

    #[Validate( ['name' => 'required|string|min:3|max:255'])]
    public $name;
    #[Validate( ['tax_id' => 'required|digits:11|unique:customers,tax_id'])]
    public $tax_id;
    #[Validate( ['birth_date' => 'required|date|before:today'])]
    public $birth_date;
    #[Validate( ['phone' => 'required|numeric|digits:11'])]
    public $phone;
    #[Validate( ['email' => 'required|email|unique:users,email'])]
    public $email;
    #[Validate( ['password' => 'required|string|min:6'])]
    public $password;
    public $customer;

    public function mount()
    {
        $this->adminId = Admin::where('user_id', Auth::id())->first()->id;
    }
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
        $this->customer = Customer::findOrFail($id);
        $this->isDeleting = true;
        $this->isEditing = false;
        $this->showModal = false;
    }

    public function deleteCustomer()
    {
        $this->customer->delete();

        $this->isDeleting = false;
        $this->isEditing = false;
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate();
        if ($this->isEditing) {
            Customer::findOrFail($this->id)->update([
                'name' => $this->name,
                'tax_id' => $this->tax_id,
                'birth_date' => $this->birth_date,
                'phone' => $this->phone,
            ]);
        } else {
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
                'admin_id' => $this->adminId
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
        $customers = Customer::where('admin_id', $this->adminId)->paginate(10);
        return view('livewire.customers', compact('customers'))
            ->layout('layouts.admin.admin', [
            'title' => 'Clientes',
            'subtitle' => 'Gerencie seus clientes'
        ]);
    }
}
