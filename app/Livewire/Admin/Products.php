<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    public $isDeleting = false;
    public $showModal = false;
    public $isEditing = false;

    public $id;
    public $name;
    public $price;
    public $hasStock = false;
    public $amount;

    public function create()
    {
        $this->reset('name', 'price', 'hasStock', 'amount');

        $this->isDeleting = false;
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);

        $this->id = $id;
        $this->name = $products->name;
        $this->price = $products->price;
        $this->hasStock = $products->hasStock;
        $this->amount = $products->amount;

        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->isEditing) {
            Product::findOrFail($this->id)->update([
                'name' => $this->name,
                'price' => $this->price,
                'hasStock' => $this->hasStock,
                'amount' => $this->amount,
            ]);
        } else {
            Product::query()->create([
                'name' => $this->name,
                'price' => $this->price,
                'hasStock' => $this->hasStock,
                'amount' => $this->amount,
            ]);
        }

        $this->reset('name', 'price', 'hasStock', 'amount');
        $this->showModal = false;
    }

    public function delete($id)
    {
        $products = Product::findOrFail($id);
        $this->showModal = false;
        $this->isEditing = false;

        $this->id = $id;
        $this->name = $products->name;

        $this->isDeleting = true;

    }

    public function confirmDelete()
    {
        Product::findOrFail($this->id)->delete();
        $this->isDeleting = false;
    }

    public function closeModal() {
        $this->isDeleting = false;
        $this->showModal = false;
        $this->isEditing = false;
    }

    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.admin.products', compact('products'))
            ->layout('layouts.admin.admin', [
                'title' => 'Produtos',
                'subtitle' => 'Gerencie seus produtos'
            ]);
    }
}
