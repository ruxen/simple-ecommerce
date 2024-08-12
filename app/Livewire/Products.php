<?php

namespace App\Livewire;

use App\Livewire\Components\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Traits\CartTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products | RuxenShop')]

class Products extends Component
{
    use WithPagination, CartTrait, LivewireAlert;

    public $selectedCategories = [];
    public $selectedBrands = [];
    public $sortBy = 'latest';

    protected $queryString = [
        'selectedCategories' => ['except' => []],
        'selectedBrands' => ['except' => []],
        'sortBy' => ['except' => 'latest'],
    ];

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
        $productsQuery = Product::query()
            ->where('is_active', 1)
            ->when($this->selectedCategories, function ($query) {
                $query->whereIn('category_id', $this->selectedCategories);
            })
            ->when($this->selectedBrands, function ($query) {
                $query->whereIn('brand_id', $this->selectedBrands);
            })
            ->when($this->sortBy === 'latest', function ($query) {
                $query->latest();
            })
            ->when($this->sortBy === 'higherprice', function ($query) {
                $query->orderBy('price', 'DESC');
            })
            ->when($this->sortBy === 'lowerprice', function ($query) {
                $query->orderBy('price', 'ASC');
            });

        return view('livewire.products', [
            'products' => $productsQuery->paginate(12),
            'brands' => Brand::select('id', 'name', 'slug')->get(),
            'categories' => Category::select('id', 'name', 'slug')->get(),
        ]);
    }
}
