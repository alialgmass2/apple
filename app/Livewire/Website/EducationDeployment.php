<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(HOME_LAYOUT)]
class EducationDeployment extends Component
{
    public function render()
    {
        return view('livewire.website.education-deployment');
    }

    public function toLogin()
    {
        return redirect()->route('user.login');
    }
}
