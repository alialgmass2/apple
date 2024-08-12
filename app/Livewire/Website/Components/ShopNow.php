<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\LearnShopNow;

class ShopNow extends Component
{
    public $learnShopNow;
    public function mount()
    {
        $this->learnShopNow = LearnShopNow::list()->latest()->first();
    }

    public function render()
    {
        return view('livewire.website.components.shop-now');
    }
}
