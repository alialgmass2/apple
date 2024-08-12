<?php

namespace App\Livewire\Admin\Vision;

use App\Models\Vision;
use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public Vision $vision;

    public function render()
    {
        return view('livewire.admin.vision.show');
    }

}
