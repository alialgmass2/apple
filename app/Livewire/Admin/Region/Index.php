<?php

namespace App\Livewire\Admin\Region;

use App\Models\Region;
use App\Traits\HasModal;
use App\Traits\HasValidation;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithPagination, HasValidation, HasModal;
    protected $paginationTheme = 'bootstrap';

    public $state = [];

    public function render()
    {
        $regions = Region::list()->paginate();
        return view('livewire.admin.region.index', [
            'regions' => $regions,
        ]);
    }

    public function showModalEdit(Region $region)
    {
        $this->state = $region->toArray();
        $this->editId = $region->id;
        $this->isEditMode = true;
        $this->isModalShow = true;
    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateRegion())->validate();

        Region::create($validated);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(Region $region)
    {
        $validated = Validator::make($this->state, $this->validateRegion($region->id))->validate();

        $region->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(Region $region)
    {
        $region->delete();
        $this->dispatch('success');
    }

}
