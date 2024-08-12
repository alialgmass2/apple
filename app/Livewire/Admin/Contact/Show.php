<?php

namespace App\Livewire\Admin\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public Contact $contact;

    public function render()
    {
        return view('livewire.admin.contact.show');
    }
}
