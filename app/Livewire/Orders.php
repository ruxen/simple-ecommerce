<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Orders | RuxenShop')]

class Orders extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::where('user_id', auth()->user()->id)->latest()->paginate(5);
        return view('livewire.orders', compact('orders'));
    }
}
