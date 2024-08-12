<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Traits\CartTrait;
use Livewire\Attributes\On;

class Navbar extends Component
{

    public $totalItems = 0;

    public function mount()
    {
        $this->totalItems = count(CartTrait::getCartItemsFromCookie());
    }

    #[On('update-cart')]
    public function updateCartItems($total)
    {
        $this->totalItems = $total;
    }

    public function render()
    {
        return view('livewire.components.navbar');
    }
}
