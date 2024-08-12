<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout(ADMIN_LAYOUT)]
class edit extends Component
{
    use WithFileUploads;
    public Product $product;
    public $editId;
    public $state = [];
    public $categories = [];
    public $subCategories = [];
    public $oldBanner;
    public $oldImage;
    public $oldImages = [];
    public $oldPdf;

    public function mount()
    {
        $this->categories = Category::list()->get();
    }

    public function render()
    {
       if ($this->state == null){
           $product = \Route::current()->parameter('product');
           $this->state =  $product->toArray();
           $this->editId = $product->id;
           $this->oldBanner = $product->getFile('banner');
           $this->oldImage = $product->getFile('default_img');
           $this->oldImages = $product->getFiles();
           $this->oldPdf = $product->getFile('pdf');
       }
        return view('livewire.admin.product.edit');
    }

    public function updatedStateCategoryId($value)
    {
        $this->subCategories = SubCategory::where('category_id', $value)->get();
    }

    public function update(Product $product)
    {
        $validated = Validator::make($this->state, [
            'category_id' => 'required|integer|exists:categories,id',
            'sub_category_id' => 'nullable|integer|exists:sub_categories,id',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'sub_title_en' => 'nullable|string',
            'sub_title_ar' => 'nullable|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'features_en' => 'required|string',
            'features_ar' => 'required|string',
            'legal_en' => 'required|string',
            'legal_ar' => 'required|string',
            'technical_specifications_en' => 'required|string',
            'technical_specifications_ar' => 'required|string',
            'specifications_en' => 'required|string',
            'specifications_ar' => 'required|string',
            'video_en' => 'nullable|string',
            'video_ar' => 'nullable|string',
            'price' => 'required|numeric',
            'banner' => 'nullable|mimes:jpeg,jpeg,tif,tiff,svg,png|image',
            'image' => 'nullable|mimes:jpeg,jpeg,svg,tif,tiff,png|image',
            'pdf' => 'nullable|mimes:pdf|file',
            'images' => 'nullable|array',
            'images.*' => 'nullable|mimes:jpeg,jpeg,tif,tiff,svg,png|image',
        ])->validate();

        $product->update($validated);
        if (toExists('banner', $this->state)) {
            $product->deleteFile('banner');
            $product->uploadFile($this->state['banner'], 'banner');
        }
        if (toExists('image', $this->state)) {
            $product->deleteFile('default_img');
            $product->uploadFile($this->state['image'], 'default_img');
        }
        if (toExists('images', $this->state)) {
            $product->deleteFiles();
            foreach ($this->state['images'] as $img) {
                $product->uploadFile($img);
            }
        }
        if (toExists('pdf', $this->state)) {
            $product->deleteFile('pdf');
            $product->uploadFile($this->state['pdf'], 'pdf');
        }
        return redirect()->route('admin.product.index')->with(['success','Product Add successfully']);
    }
}
