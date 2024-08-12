<?php

namespace App\Livewire;

use App\Livewire\Components\Navbar;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Traits\CartTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('Cart | RuxenShop')]

class Cart extends Component
{
    use CartTrait, LivewireAlert;

    public $items = [];
    public $total = 0;
    public $canCheckout = true;
    public $productStocks = [];

    public function mount()
    {
        $this->loadCart();
    }

    private function loadCart()
    {
        $this->items = CartTrait::getCartItemsFromCookie();
        $this->loadProductStocks();
        $this->calculateTotalAndStock();
    }

    private function loadProductStocks()
    {
        $productIds = array_column($this->items, 'product_id');
        $products = Product::whereIn('id', $productIds)->get();
        $this->productStocks = $products->pluck('stock', 'id')->toArray();
    }

    private function calculateTotalAndStock()
    {
        $this->total = CartTrait::calculateGrandTotal($this->items);
        $this->canCheckout = $this->validateCartStock();
    }

    public function removeItem($productId)
    {
        $this->items = CartTrait::removeCartItems($productId);
        $this->calculateTotalAndStock();

        $this->dispatch('update-cart', total: count($this->items))->to(Navbar::class);
        $this->alert('success', 'Product successfully removed from your cart', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function increaseQty($productId)
    {
        $itemKey = CartTrait::findCartItemKey($this->items, $productId);

        if ($itemKey !== null && $this->items[$itemKey]['quantity'] < $this->productStocks[$productId]) {
            $this->items = CartTrait::incrementQuantityToCartItem($productId);
            $this->calculateTotalAndStock();
        } else {
            $this->alert('warning', 'Only ' . $this->productStocks[$productId] . ' items available', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }

    public function decreaseQty($productId)
    {
        $this->items = CartTrait::decrementQuantityToCartItem($productId);
        $this->calculateTotalAndStock();
    }

    private function validateCartStock(): bool
    {
        foreach ($this->items as $item) {
            if ($item['quantity'] > $this->productStocks[$item['product_id']]) {
                return false;
            }
        }
        return true;
    }

    public function redirectToCheckout()
    {
        if ($this->canCheckout) {
            return redirect()->route('checkout');
        } else {
            $this->alert('warning', 'Cannot proceed to checkout due to stock issues', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
