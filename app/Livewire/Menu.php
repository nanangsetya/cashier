<?php

namespace App\Livewire;

use App\Models\Detail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

class Menu extends Component
{
    public $products, $carts;

    public function mount()
    {
        $this->carts = \Cart::session(auth()->user()->id)->getContent()->sort();
        $this->products = Product::orderBy('type_id')->get();
    }

    public function render()
    {
        return view('livewire.menu');
    }

    public function storeCart($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->render();
        }

        $cart = \Cart::session(auth()->user()->id)->get($id);
        if ($cart) {
            \Cart::update($id, array(
                'quantity' => 1,
            ));
        } else {
            \Cart::add([
                'id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ]);
        }
        $this->carts = \Cart::session(auth()->user()->id)->getContent()->sort();
    }

    public function add($id)
    {
        \Cart::session(auth()->user()->id)->update($id, array(
            'quantity' => 1,
        ));
        $this->carts = \Cart::getContent()->sort();
    }

    public function reduce($id)
    {
        $cart = \Cart::session(auth()->user()->id)->get($id);
        if ($cart->quantity == 1) {
            \Cart::remove($id);
        } else {
            \Cart::session(1)->update($id, array(
                'quantity' => -1,
            ));
        }
        $this->carts = \Cart::getContent()->sort();
    }

    #[On('store-order')]
    public function store()
    {
        try {
            DB::beginTransaction();
            $transaction = Transaction::create([
                'unique_id' => time() . auth()->user()->id . Str::random(3),
                'created_by' => auth()->user()->id
            ]);
            $carts = \Cart::session(auth()->user()->id)->getContent()->sort();
            foreach ($carts as $c) {
                Detail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $c->id,
                    'qty' => $c->quantity,
                    'price' => $c->price
                ]);
            }
            DB::commit();
            \Cart::session(auth()->user()->id)->clear();
            $this->carts = \Cart::session(auth()->user()->id)->getContent()->sort();
            $this->dispatch('notification', ['icon' => 'success', 'message' => 'Transaksi berhasil']);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notification', ['icon' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
