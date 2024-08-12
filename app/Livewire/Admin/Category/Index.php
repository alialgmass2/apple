<?php

namespace App\Livewire\Admin\Category;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithFileUploads;

    #[Locked]
    public $isModalShow = false;
    #[Locked]
    public $isEditMode = false;
    #[Locked]
    public $editId;
    public $state = [];

    public function render()
    {
        $categories = Category::list()->get();
        return view('livewire.admin.category.index', [
            'categories' => $categories,
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

    public function showModalEdit(Category $category)
    {
        $this->state = $category->toArray();
        $this->editId = $category->id;
        $this->isEditMode = true;
        $this->isModalShow = true;
    }

    public function store()
    {

        $validated = Validator::make($this->state, [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'image' => 'required'

        ])->validate();

        if (!empty($this->state['image'])) {
            $imageName = time() . '.' . $this->state['image']->getClientOriginalExtension();
            // Move the uploaded image to the 'uploads' directory
            $storedPath = $this->state['image']->storeAs("public/cat", $imageName);
            // Update the validated data with the image name
            $validated['image'] = $storedPath;

        }

        $cat = Category::create($validated);

        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }

    public function update(Category $category)
    {
        $validated = Validator::make($this->state, [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'image' => 'nullable|image'
        ])->validate();

        if (Storage::exists($category->image ?? ' ')) {
            // Delete the file
            Storage::delete($category->image);

        }
        if (!empty($this->state['image'])) {
            $imageName = time() . '.' . $this->state['image']->getClientOriginalExtension();
            // Move the uploaded image to the 'uploads' directory
            $storedPath = $this->state['image']->storeAs("public/cat", $imageName);
            // Update the validated data with the image name
            $validated['image'] = $storedPath;

        }


        $category->update($validated);

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(Category $category)
    {
        $category->delete();
        $this->dispatch('success');
    }


}
