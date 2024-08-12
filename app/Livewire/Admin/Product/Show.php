<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public Product $product;

    public function render()
    {
        return view('livewire.admin.product.show');
    }
}
