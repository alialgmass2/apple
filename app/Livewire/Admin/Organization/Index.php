<?php

namespace App\Livewire\Admin\Organization;

use App\Dtos\FetchCitiesRequestDTO;
use App\Models\City;
use App\Models\EducationLevel;
use App\Models\Organization;
use App\Models\Region;
use App\Services\AramexService;
use App\Traits\HasModal;
use App\Traits\HasValidation;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithFileUploads, WithPagination, HasValidation, HasModal;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $regions = [];
    public $cities = [];
    public $shipment_cities = [];
    public $educationLevels = [];
    public $oldBanner;
    public $oldImage;
    public $oldBannerDashboard;
    public $oldLogoLogin;

    public function mount()
    {
        $this->regions = Region::listDropdown()->get();
        $class = new FetchCitiesRequestDTO();
        $class->countryCode = 'SA';
        $this->shipment_cities = (new AramexService())->fetchCities($class)['Cities'];
        $this->educationLevels = EducationLevel::listDropdown()->get();
    }

    public function render()
    {
        $organizations = Organization::list()->paginate();
        return view('livewire.admin.organization.index', [
            'organizations' => $organizations,
        ]);
    }

    public function updatedStateRegionId($value)
    {
        $this->cities = City::listDropdownByRegionId($value)->get();
    }

    public function showModalEdit(Organization $organization)
    {
        $this->cities = City::listDropdownByRegionId($organization->region_id)->get();
        $this->state = $organization->toArray();
        $this->editId = $organization->id;
        $this->oldBanner = $organization->getFile('banner');
        $this->oldImage = $organization->getFile();
        $this->oldBannerDashboard = $organization->getFile('banner_dashboard');
        $this->oldLogoLogin = $organization->getFile('logo_login');
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateOrganization())->validate();
        $organization = Organization::create($validated);

        if (toExists('banner', $this->state)) {
            $organization->uploadFile($this->state['banner'], 'banner');
        }

        if (toExists('image', $this->state)) {
            $organization->uploadFile($this->state['image']);
        }

        if (toExists('banner_dashboard', $this->state)) {
            $organization->uploadFile($this->state['banner_dashboard'], 'banner_dashboard');
        }

        if (toExists('logo_login', $this->state)) {
            $organization->uploadFile($this->state['logo_login'], 'logo_login');
        }

        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(Organization $organization)
    {
        $validated = Validator::make($this->state, $this->validateOrganizationUpdate($organization->id))->validate();

        $organization->update($validated);
        if (toExists('banner', $this->state)) {
            $organization->deleteFile('banner');
            $organization->uploadFile($this->state['banner'], 'banner');
        }
        if (toExists('image', $this->state)) {
            $organization->deleteFile();
            $organization->uploadFile($this->state['image']);
        }

        if (toExists('banner_dashboard', $this->state)) {
            $organization->deleteFile('banner_dashboard');
            $organization->uploadFile($this->state['banner_dashboard'], 'banner_dashboard');
        }

        if (toExists('logo_login', $this->state)) {
            $organization->deleteFile('logo_login');
            $organization->uploadFile($this->state['logo_login'], 'logo_login');
        }

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(Organization $organization)
    {
        $organization->delete();
        $this->dispatch('success');
    }

}
