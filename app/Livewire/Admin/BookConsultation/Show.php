<?php

namespace App\Livewire\Admin\BookConsultation;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\BookConsultation;

 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public BookConsultation $bookconsultation;

    public function render()
    {
        return view('livewire.admin.book-consultation.show');
    }

}
