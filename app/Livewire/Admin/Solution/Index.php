<?php

namespace App\Livewire\Admin\Solution;

use App\Models\Solution;
use App\Traits\HasValidation;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    use WithFileUploads, HasValidation;
    #[Locked]
    public $isModalShow = false;
    #[Locked]
    public $isEditMode = false;
    #[Locked]
    public $editId;
    public $state = [];
    public $oldImage;

    public function render()
    {
        $solution = Solution::list()->first();
        return view('livewire.admin.solution.index', [
            'solution' => $solution,
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

    public function showModalEdit(Solution $solution)
    {
        $this->state = $solution->toArray();
        $this->editId = $solution->id;
        $this->oldImage = $solution->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(Solution $solution)
    {
        $validated = Validator::make($this->state, $this->validateParental($solution->id))->validate();

        $solution->update($validated);

        if (toExists('image', $this->state)) {
            $solution->deleteFile();
            $solution->uploadFile($this->state['image']);
        }

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
