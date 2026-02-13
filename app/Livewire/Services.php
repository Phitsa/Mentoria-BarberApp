<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;

class Services extends Component
{
    use WithPagination;

    public $isDeleting = false;
    public $showModal = false;
    public $isEditing = false;
    public $serviceId = null;

    public $description;
    public $price;
    public $name;

    protected $rules = [
            'price' => 'required|numeric',
            'name'  => 'required|min:3',
            'description' => 'nullable',
    ];

    public function create() {
        $this->reset(['name', 'price', 'serviceId', 'description']);

        $this->isDeleting = false;
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit($id) {
        $service = Service::findOrFail($id);

        $this->serviceId = $id;
        $this->price = $service->price;
        $this->name = $service->name;
        $this->description = $service->description;

        $this->isDeleting = false;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function delete($id) {
        $service = Service::findOrFail($id);

        $this->serviceId = $id;
        $this->name = $service->name;

        $this->showModal = false;
        $this->isDeleting = true;
    }

    public function save() {
        $this->validate();

        if ($this->isEditing) {
            Service::find($this->serviceId)->update([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
            ]);
        } else {
            Service::query()->create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
            ]);
        }

        $this->reset(['name', 'price', 'serviceId', 'description']);
        $this->showModal = false;

    }

    public function confirmDelete($id) {
        $this->isDeleting = false;
        $service = Service::findOrFail($id);
        $service->delete();
    }

    public function closeModal() {
        $this->isDeleting = false;
        $this->showModal = false;
        $this->isEditing = false;
    }

    public function render() {
        $services = Service::paginate(10);

        return view('livewire.services', compact('services'))
            ->layout('layouts.admin.admin', [
                'title' => 'Serviços',
                'subtitle' => 'Gerencie seus serviços'
            ]);
    }

}
