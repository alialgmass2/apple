<?php

namespace App\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;
use App\Traits\HasModal;
use Livewire\WithPagination;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Validator;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithPagination, HasValidation,  HasModal;
    protected $paginationTheme = 'bootstrap';

    public $state = [];

    public function render()
    {
        $roles = Role::list()->paginate();
        return view('livewire.admin.role.index', [
            'roles' => $roles,
        ]);
    }


     public function showModalEdit(Role $role)
    {
        $this->state = $role->toArray();
        $this->editId = $role->id;
        $this->isEditMode = true;
        $this->isModalShow = true;
    }

    public function store()
    {
        $validated = Validator::make($this->state,$this->validateRole())->validate();
        Role::create($validated);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(Role $role)
    {
        $validated = Validator::make($this->state, $this->validateRole($role->id))->validate();

        $role->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(Role $role)
    {
        $role->delete();
        $this->dispatch('success');
    }


}
