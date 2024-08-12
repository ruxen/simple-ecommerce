<?php

namespace App\Livewire;

use App\Livewire\Components\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Traits\CartTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('All about Tech | RuxenShop')]

class Home extends Component
{
    use LivewireAlert;

    public function addToCart($productId)
    {
        $totalItems = CartTrait::addItemToCart($productId);

        $this->dispatch('update-cart', total: $totalItems)->to(Navbar::class);
        $this->alert('success', 'Product successfully added to your cart', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function render()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::where('is_active', 1)->orderBy('created_at', 'DESC')->limit(12)->get();

        return view('livewire.home', compact(
            'brands',
            'categories',
            'products'
        ));
    }
}
