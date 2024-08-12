<?php

namespace App\Livewire\Website\Components;

use App\Models\Banner;
use App\Models\HomeIntro;
use Livewire\Component;

class HomeBanner extends Component
{
    public $banner;
    public $homeIntro;
    public function mount()
    {
        $this->banner = Banner::list()->first();
        $this->homeIntro = HomeIntro::list()->first();
        // $this->homeIntro = HomeIntro::latest()->first();
    }
    public function render()
    {
        return view('livewire.website.components.home-banner');
    }
}
