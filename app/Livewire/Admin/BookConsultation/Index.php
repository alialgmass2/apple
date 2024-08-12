<?php

namespace App\Livewire\Admin\BookConsultation;

use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Models\BookConsultation;
use Illuminate\Support\Facades\Validator;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use HasValidation;
    #[Locked]
    public $isModalShow = false;
    #[Locked]
    public $isEditMode = false;
    #[Locked]
    public $editId;
    public $state = [];


    public function render()
    {
        $bookConsultation = BookConsultation::list()->first();
        return view('livewire.admin.book-consultation.index', [
            'bookConsultation' => $bookConsultation,
        ]);
    }

    public function showModal()
    {
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = true;
    }

    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
    }

    public function showModalEdit(BookConsultation $bookconsultation)
    {
        $this->state = $bookconsultation->toArray();
        $this->editId = $bookconsultation->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(BookConsultation $bookconsultation)
    {
        $validated = Validator::make($this->state, $this->validateCustomisedSolution())->validate();

        $bookconsultation->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }


}
