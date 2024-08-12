<?php

namespace App\Livewire\Admin\EveryOneCreate;

use Livewire\Component;
use App\Models\EveryOneCreate;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public EveryOneCreate $everyonecreate;

    public function render()
    {
        return view('livewire.admin.every-one-create.show');
    }

}
