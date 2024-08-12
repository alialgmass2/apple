<?php

namespace App\Livewire\Admin\SubCategory;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;

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
    public $categories = [];

    public function mount()
    {
        $this->categories = Category::list()->get();
    }

    public function render()
    {
        $subCategories = SubCategory::list()->get();
        return view('livewire.admin.sub-category.index', [
            'subCategories' => $subCategories,
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

    public function showModalEdit(SubCategory $subcategory)
    {
        $this->state = $subcategory->toArray();
        $this->editId = $subcategory->id;
        $this->isEditMode = true;
        $this->isModalShow = true;
    }

    public function store()
    {
        $validated = Validator::make($this->state, [
            'category_id' => 'required|integer|exists:categories,id',
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
        ])->validate();

        SubCategory::create($validated);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(SubCategory $subcategory)
    {
        $validated = Validator::make($this->state, [
            'category_id' => 'required|integer|exists:categories,id',
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
        ])->validate();

        $subcategory->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(SubCategory $subcategory)
    {
        $subcategory->delete();
        $this->dispatch('success');
        // $this->success();
    }

}
