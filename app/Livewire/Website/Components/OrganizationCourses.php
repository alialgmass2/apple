<?php

namespace App\Livewire\Website\Components;

use App\Models\Course;
use Livewire\Component;

class OrganizationCourses extends Component
{
    public $courses;
    public $popup; 
    public function mount()
    {
        $this->courses = Course::list()->get();
        $this->popup = '';
    }
    public function render()
    { 
        return view('livewire.website.components.organization-courses');
    }

    public function setPopup($popup)
    {
        $this->popup =
            '
            <div class="pop_up" >
                <div class="pop_up_content" style="width:max-content">
                    <div class="remove " style="" onclick=removeVideo()>
                        <i class="fa fa-close " style=""></i>
                    </div>
                    <div class="video_body">
                        <video width="100%" height="492" controls autoplay loop muted >
                            <source src="'.$popup.'" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
            ';
            
    // $this->emit('videoPopupDisplayed');
        // $this->dispatchBrowserEvent('videoPopupDisplayed');
        // $this->emitTo('organization-courses', 'videoPopupDisplayed');
    
    }

    public function save()
    {
        dd('#HERE# SAVE');
    }
}
