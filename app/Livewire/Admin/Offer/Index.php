<?php

namespace App\Livewire\Admin\Offer;

use App\Models\Offer;
use Carbon\Carbon;
use Livewire\Component;
use App\Traits\HasModal;
use Livewire\WithPagination;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;


#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithPagination, HasValidation,  HasModal , WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $oldImage;
    public $oldMultiImage;
    public $oldCover;

    public function mount()
    {
//        isset($this->state['start_date']) ? $this->state['start_date'] = Carbon::parse($this->state['start_date'])->format('m/d/Y') : '';
//        isset($this->state['end_date']) ? $this->state['end_date'] = Carbon::parse($this->state['end_date'])->format('m/d/Y') : '';
    }
    public function render()
    {
        $offer = Offer::list()->paginate();
        return view('livewire.admin.offer.index', [
            'offers' => $offer,
        ]);
    }


     public function showModalEdit(Offer $offer)
    {
        $this->oldImage = $offer->getFile('banner');
        $this->oldMultiImage = $offer->getFilesUrl('multi_banner');
        $this->oldCover = $offer->getFile('default_img');
        $this->state = $offer->toArray();
        $this->editId = $offer->id;
        $this->isEditMode = true;
        $this->isModalShow = true;
    }

    public function store()
    {
        $validated = \Validator::make($this->state,$this->validateOffer())->validate();
        $offer = Offer::create($validated);
        if (toExists('multi_banner', $this->state)) {
            foreach ($this->state['multi_banner'] as $img) {
                $offer->uploadFile($img, 'multi_banner');
            }
        }
        if (toExists('banner', $this->state)) {
            $offer->uploadFile($this->state['banner'], 'banner');
        }
        if (toExists('image', $this->state)) {
            $offer->uploadFile($this->state['image'], 'default_img');
        }
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(Offer $offer)
    {
        $validated = \Validator::make($this->state, $this->validateOffer($offer->id))->validate();
        $offer->update($validated);
        if (toExists('multi_banner', $this->state)) {
                $offer->deleteFiles('multi_banner');
            foreach ($this->state['multi_banner'] as $img) {
                $offer->uploadFile($img, 'multi_banner');
            }
        }
        if (toExists('banner', $this->state)) {
            $offer->uploadFile($this->state['banner'], 'banner');
        }
        if (toExists('image', $this->state)) {
            $offer->deleteFile('default_img');
            $offer->uploadFile($this->state['image'], 'default_img');
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');
    }

    public function delete(Offer $offer)
    {
        $offer->delete();
        $this->dispatch('success');
    }


}
