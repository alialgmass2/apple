<?php

namespace App\Livewire\Website\Components;

use App\Models\Solution;
use Livewire\Component;

class Solutions extends Component
{
    public $solution;

    public function mount()
    {
        $this->solution = Solution::list()->first();
    }

    public function render()
    {
        return view('livewire.website.components.solutions');
    }
}
