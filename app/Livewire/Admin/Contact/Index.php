<?php

namespace App\Livewire\Admin\Contact;

use App\Models\Contact;
use Livewire\Component;
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
        $contacts = Contact::list()->paginate();
        return view('livewire.admin.contact.index', [
            'contacts' => $contacts,
        ]);
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
        $this->dispatch('success');
    }

}
