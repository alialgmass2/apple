<?php

namespace App\Livewire\Admin\CustomisedSolution;

use App\Models\CustomisedSolution;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public CustomisedSolution $customisedsolution;

    public function render()
    {
        return view('livewire.admin.customised-solution.show');
    }

}
