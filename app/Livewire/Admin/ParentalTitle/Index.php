<?php

namespace App\Livewire\Admin\ParentalTitle;

use Livewire\Component;
use App\Models\ParentalTitle;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
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
        $parentalTitles = ParentalTitle::listAdmin()->get();
        return view('livewire.admin.parental-title.index', [
            'parentalTitles' => $parentalTitles,
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

    public function showModalEdit(ParentalTitle $parentaltitle)
    {
        $this->state = $parentaltitle->toArray();
        $this->editId = $parentaltitle->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateParentalTitle())->validate();
        ParentalTitle::create($validated);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(ParentalTitle $parentalTitle)
    {
        $validated = Validator::make($this->state,$this->validateParentalTitle())->validate();

        $parentalTitle->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(ParentalTitle $parentalTitle)
    {
        $parentalTitle->delete();
        $this->dispatch('success');
    }

}
