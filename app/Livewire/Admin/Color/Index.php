<?php

namespace App\Livewire\Admin\Color;

use App\Models\Category;
use App\Models\Color;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    #[Locked]
    public $isModalShow = false;
    #[Locked]
    public $isEditMode = false;
    #[Locked]
    public $editId;
    public $state = [];

    public function render()
    {
        $colors = Color::list()->get();
        return view('livewire.admin.color.index', [
            'colors' => $colors,
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

    public function showModalEdit(Color $color)
    {
        $this->state = $color->toArray();
        $this->editId = $color->id;
        $this->isEditMode = true;
        $this->isModalShow = true;
    }

    public function store()
    {
        $validated = Validator::make($this->state, [
            'color_code' => ['required','regex:/^(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))$/i'],
            'color_name' => 'nullable',
        ])->validate();

        Color::create($validated);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(Color $color)
    {
        $validated = Validator::make($this->state, [
            'color_code' => ['required','regex:/^(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))$/i'],
            'color_name' => 'nullable',
        ])->validate();

        $color->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(SubCategory $subcategory)
    {
        $subcategory->delete();
        $this->dispatch('success');
    }

}
