<?php

namespace App\Livewire\Admin\City;

use App\Models\City;
use App\Models\Region;
use App\Traits\HasModal;
use App\Traits\HasValidation;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Validator;

#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithPagination, HasValidation,  HasModal;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $regions = [];

    public function mount()
    {
        $this->regions = Region::listDropdown()->get();
    }

    public function render()
    {
        $cities = City::list()->paginate();
        return view('livewire.admin.city.index', [
            'cities' => $cities,
        ]);
    }



    public function showModalEdit(City $city)
    {
        $this->state = $city->toArray();
        $this->editId = $city->id;
        $this->isEditMode = true;
        $this->isModalShow = true;
    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateCity())->validate();

        City::create($validated);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(City $city)
    {
        $validated = Validator::make($this->state, $this->validateCity($city->id))->validate();

        $city->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(City $city)
    {
        $city->delete();
        $this->dispatch('success');
    }

}
