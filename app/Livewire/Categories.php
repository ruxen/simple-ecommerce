<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Categories | RuxenShop')]

class Categories extends Component
{
    public function render()
    {
        $categories = Category::all();

        return view('livewire.categories', compact('categories'));
    }
}
