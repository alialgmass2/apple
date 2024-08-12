<?php

namespace App\Livewire\Admin\BookAConsultant;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\BookAConsulation;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];

    public function render()
    {
        $contacts = BookAConsulation::list()->paginate();
        return view('livewire.admin.book-a-consultant.index', [
            'contacts' => $contacts,
        ]);
    }

    public function delete(BookAConsulation $bookaconsulation)
    {
        $bookaconsulation->delete();
        $this->dispatch('success');
    }


}
