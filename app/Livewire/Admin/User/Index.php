<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    public $state = [];

    public function render()
    {
        $users = User::with('region:id,'.toLocale('name'),'city:id,'.toLocale('name'),'educationLevel:id,'.toLocale('name'),'organization:id,'.toLocale('name'))->latest()->get();
        return view('livewire.admin.user.index', [
            'users' => $users,
        ]);
    }


    public function delete(User $user)
    {
        $user->orders()->delete();
        $user->address()->delete();

        $user->cart()->delete();
        $user->delete();
        $this->dispatch('success');
    }

}
