<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;
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
        $services = Service::listAdmin()->get();
        return view('livewire.admin.service.index', [
            'services' => $services,
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

    public function showModalEdit(Service $service)
    {
        $this->state = $service->toArray();
        $this->editId = $service->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateService())->validate();
        Service::create($validated);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(Service $service)
    {
        $validated = Validator::make($this->state,$this->validateService())->validate();

        $service->update($validated);

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(Service $service)
    {
        $service->delete();
        $this->dispatch('success');
    }



}
