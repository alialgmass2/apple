<?php

namespace App\Livewire\Admin\Organization;

use App\Models\Organization;
use Livewire\Component;
use Livewire\Attributes\Layout;

 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public Organization $organization;


    public function render()
    {
        return view('livewire.admin.organization.show');
    }
}
