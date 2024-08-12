<?php

namespace App\Livewire\Admin\EducationLevel;

use Livewire\Component;
use App\Traits\HasModal;
use Livewire\WithPagination;
use App\Traits\HasValidation;
use App\Models\EducationLevel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;

 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithPagination, HasValidation,  HasModal;
    protected $paginationTheme = 'bootstrap';

    public $state = [];

    public function render()
    {
        $educationLevels = EducationLevel::list()->paginate();
        return view('livewire.admin.education-level.index', [
            'educationLevels' => $educationLevels,
        ]);
    }


     public function showModalEdit(EducationLevel $educationlevel)
    {
        $this->state = $educationlevel->toArray();
        $this->editId = $educationlevel->id;
        $this->isEditMode = true;
        $this->isModalShow = true;
    }

    public function store()
    {
        $validated = Validator::make($this->state,$this->validateEducationLevel())->validate();
        EducationLevel::create($validated);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(EducationLevel $educationlevel)
    {
        $validated = Validator::make($this->state, $this->validateEducationLevel($educationlevel->id))->validate();

        $educationlevel->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(EducationLevel $educationlevel)
    {
        $educationlevel->delete();
        $this->dispatch('success');
    }


}
