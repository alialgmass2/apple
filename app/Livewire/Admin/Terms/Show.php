<?php

namespace App\Livewire\Admin\Terms;

use App\Models\Contact;
use App\Models\Term;
use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public Term $terms;

     public function render()
    {
        return view('livewire.admin.terms.show');
    }
}
