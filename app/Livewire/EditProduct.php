<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EditProduct extends Component
{
    use WithFileUploads;

    public $types, $type, $name, $price, $image, $product, $prev_image;

    public function mount($product)
    {
        $this->product = $product;
        $this->types = Type::get();
        $this->type = $product->type_id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->prev_image = $product->image;
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
            'image' => 'nullable|mimes:jpeg,png,jpg'
        ]);

        try {
            DB::beginTransaction();

            $product = Product::find($this->product->id);

            if ($this->image) {
                $manager = new ImageManager(new Driver());
                $filename = rand(1, 100) . time() . '.' . $this->image->getClientOriginalExtension();
                $img = $manager->read($this->image);
                if ($img->width() > 500) {
                    $img->scale(width: 500);
                }
                $img->save(public_path('images/') . $filename);
                $product->image = '/images/' . $filename;
            }

            $product->type_id = $this->type;
            $product->name = $this->name;
            $product->price = $this->price;
            $product->updated_by = auth()->user()->id;
            $product->save();
            
            DB::commit();
            return redirect('product')->with('success', 'Product successfully updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('failed', $e->getMessage());
        }
    }
}
