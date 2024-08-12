<?php

namespace App\Livewire\Admin\CustomisedSolution;

use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Models\CustomisedSolution;
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
        $customisedSolution = CustomisedSolution::list()->first();
        return view('livewire.admin.customised-solution.index', [
            'customisedSolution' => $customisedSolution,
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

    public function showModalEdit(CustomisedSolution $customisedsolution)
    {
        $this->state = $customisedsolution->toArray();
        $this->editId = $customisedsolution->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(CustomisedSolution $customisedsolution)
    {
        $validated = Validator::make($this->state, $this->validateCustomisedSolution())->validate();

        $customisedsolution->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }


}
