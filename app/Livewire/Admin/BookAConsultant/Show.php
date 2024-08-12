<?php

namespace App\Livewire\Admin\BookAConsultant;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\BookAConsulation;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public BookAConsulation $bookaconsulation;

    public function render()
    {
        return view('livewire.admin.book-a-consultant.show');
    }
}
