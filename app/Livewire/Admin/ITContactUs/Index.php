<?php

namespace App\Livewire\Admin\ITContactUs;

use Livewire\Component;
use App\Models\ITContactUs;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];

    public function render()
    {
        $contacts = ITContactUs::list()->paginate();
        return view('livewire.admin.i-t-contact-us.index', [
            'contacts' => $contacts,
        ]);
    }

    public function delete(ITContactUs $itcontactus)
    {
        $itcontactus->delete();
        $this->dispatch('success');
    }


}
