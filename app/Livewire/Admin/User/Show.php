<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.admin.user.show');
    }
}
