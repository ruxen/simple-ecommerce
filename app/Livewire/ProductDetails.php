<?php

namespace App\Livewire;

use App\Livewire\Components\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Traits\CartTrait;

#[Title('Product Details | RuxenShop')]

class ProductDetails extends Component
{
    use CartTrait, LivewireAlert;

    public $product;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
    }

    public function increaseQty()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        } else {
            $this->alert('warning', 'Only ' . $this->product->stock . ' items available', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }

    public function decrementQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($productId)
    {
        $totalItems = CartTrait::addItemToCart($productId, $this->quantity);

        $this->dispatch('update-cart', total: $totalItems)->to(Navbar::class);
        $this->alert('success', 'Product successfully added to your cart', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function render()
    {
        if ($this->product->stock == 0) {
            $this->quantity = 0;
        }

        return view('livewire.product-details');
    }
}
