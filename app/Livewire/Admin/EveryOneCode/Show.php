<?php

namespace App\Livewire\Admin\EveryOneCode;

use Livewire\Component;
use App\Models\EveryOneCode;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public EveryOneCode $everyonecode;

    public function render()
    {
        return view('livewire.admin.every-one-code.show');
    }

}
