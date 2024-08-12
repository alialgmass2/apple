<?php

namespace App\Livewire\Admin\Terms;

use App\Models\Term;
use App\Models\TermHeader;
use App\Traits\HasModal;
use App\Traits\HasValidation;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithPagination , HasValidation,  HasModal;
    protected $paginationTheme = 'bootstrap';

    public $state = [];

    public function render()
    {
        $terms = Term::orderBy('created_at','desc')->list()->paginate();
        return view('livewire.admin.terms.index', [
            'terms' => $terms,
        ]);
    }
     public function showModalEdit(Term $term)
     {
         $this->state = $term->toArray();
//         dd($term->id);
         $this->editId = $term->id;
         $this->isModalHeader = false;
         $this->isEditMode = true;
         $this->isModalShow = true;
     }

     public function store()
     {
         $validated = Validator::make($this->state, $this->validateTerms())->validate();
         Term::create($validated);
         $this->closeModal();
         $this->alertSuccess('Data Saved');
     }
     public function showModalHeader(TermHeader $header)
     {
         $this->state = $header->first()->toArray();
         $this->isModalHeader = true;
         $this->isModalShow = true;
     }
     public function storeHeader()
     {
         $validated = Validator::make($this->state, $this->validateTermsHeader())->validate();
         TermHeader::where('id',1)->update($validated);
         $this->closeModal();
         $this->alertSuccess('Data Saved');
     }
     public function update(Term $term)
     {
         $validated = Validator::make($this->state, $this->validateTerms($term->id))->validate();
         $term->update($validated);
         $this->closeModal();
         $this->alertSuccess('Data updated');
     }
     public function remove($key)
     {
         unset($this->state['content_en'][$key]);
         unset($this->state['content_ar'][$key]);
     }

     public function delete(Term $term)
     {
         $term->delete();
         $this->dispatch('success');
     }

}
