<?php

namespace App\Livewire;

use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    public $products;

    public function mount()
    {
        $this->products = ModelsProduct::get();
    }

    public function render()
    {
        return view('livewire.product');
    }
}
