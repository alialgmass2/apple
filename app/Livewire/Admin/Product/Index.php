<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    use WithFileUploads;
    #[Locked]
    public $isModalShow = false;
    #[Locked]
    public $isEditMode = false;
    public $isEditLinkMode = false;
    #[Locked]
    public $editId;
    public $state = [];
    public $categories = [];
    public $colors = [];
    public $subCategories = [];
    public $oldBanner;
    public $oldImage;
    public $oldImages = [];
    public $oldPdf;
    public $category_id;

    public function mount()
    {
        $this->categories = Category::list()->get();
        $this->colors = Color::list()->get();
    }

    public function render()
    {
        $products = Product::listAdmin($this->category_id)->paginate(6);
        return view('livewire.admin.product.index', [
            'products' => $products,
        ]);
    }

//    public function updatedStateCategoryId($value)
//    {
//        $this->subCategories = SubCategory::where('category_id', $value)->get();
//    }

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

    public function showModalEdit(Product $product)
    {
        $this->state = $product->getFiles('default')->toArray();
        if ($this->state != null){
            foreach ($this->state as $key => $value) {
                $this->state[$value['id']] = $value['color_code'];
            }
        }
        $this->isEditMode = true;
        $this->isEditLinkMode = false;
        $this->isModalShow = true;
    }

    public function showModalLinkEdit($id)
    {
        $product = Product::find($id);
        $this->editId = $id;
        if ($product->links != null){
            $this->state['specifications'] = $product->links['specifications']??'';
            $this->state['features'] = $product->links['features']??'';
            $this->state['legal'] = $product->links['legal']??'';
            $this->state['technical_specifications'] = $product->links['technical_specifications']??'';
        }
        $this->isEditLinkMode = true;
        $this->isEditMode = false;
        $this->isModalShow = true;
    }

    public function saveImagesColor()
    {
        if ($this->state !=  null){
            foreach ($this->state as $key => $value) {
                Image::where('id', $key)->update([
                    'color_code' => $value
                ]);
            }
        }
        $this->closeModal();
        $this->alertSuccess('Data Saved');
    }
    public function saveLinks(Product $product)
    {
        if ($this->state !=  null){
            $product->update(['links'=>$this->state]);
        }
        $this->closeModal();
        $this->alertSuccess('Data Saved');
    }


    public function delete(Product $product)
    {
        $product->delete();
        $this->dispatch('success');
    }

}
