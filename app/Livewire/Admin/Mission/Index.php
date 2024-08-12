<?php

namespace App\Livewire\Admin\Mission;

use App\Models\Mission;
use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;



 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    use WithFileUploads,HasValidation;

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
        $missions = Mission::listAdmin()->get();
        return view('livewire.admin.mission.index', [
            'missions' => $missions,
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

    public function showModalEdit(Mission $mission)
    {
        $this->state = $mission->toArray();
        $this->editId = $mission->id;
        $this->oldImage = $mission->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateMissions())->validate();
        $mission = Mission::create($validated);
        if (toExists('image', $this->state)) {
            $mission->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(Mission $mission)
    {
        $validated = Validator::make($this->state,$this->validateMissions($mission->id))->validate();

        $mission->update($validated);

        if (toExists('image', $this->state)) {
            $mission->deleteFile();
            $mission->uploadFile($this->state['image']);
        }

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(Mission $mission)
    {
        $mission->delete();
        $this->dispatch('success');
    }



}
