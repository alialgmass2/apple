<?php

namespace App\Livewire\Admin\ITContactUs;

use Livewire\Component;
use App\Models\ITContactUs;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public ITContactUs $itcontactus;

    public function render()
    {
        return view('livewire.admin.i-t-contact-us.show');
    }

}
