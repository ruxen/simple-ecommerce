<?php

namespace App\Livewire\Components;

use App\Models\Category;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $categories = Category::limit(3)->get();

        return view('livewire.components.footer', compact('categories'));
    }
}
