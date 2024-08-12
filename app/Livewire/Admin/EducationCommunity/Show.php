<?php

namespace App\Livewire\Admin\EducationCommunity;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\EducationCommunity;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public EducationCommunity $educationcommunity;

    public function render()
    {
        return view('livewire.admin.education-community.show');
    }
}
