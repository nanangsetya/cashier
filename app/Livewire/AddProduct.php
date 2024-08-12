<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Livewire\Component;

class AddProduct extends Component
{
    use WithFileUploads;

    public $types, $type, $name, $price, $image;

    public function mount()
    {
        $this->type = Type::first()->id;
        $this->types = Type::get();
    }

    public function render()
    {
        return view('livewire.form-product');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required|integer|min:2',
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);

        try {
            DB::beginTransaction();

            $manager = new ImageManager(new Driver());
            $filename = rand(1, 100) . time() . '.' . $this->image->getClientOriginalExtension();
            $img = $manager->read($this->image);
            if ($img->width() > 500) {
                $img->scale(width: 500);
            }
            $img->save(public_path('images/') . $filename);

            Product::create([
                'type_id' => $this->type,
                'name' => $this->name,
                'price' => $this->price,
                'image' => '/images/' . $filename,
                'created_by' => auth()->user()->id,
            ]);
            DB::commit();
            return redirect('product')->with('success', 'Product successfully stored.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('failed', $e->getMessage());
        }
    }
}
