<?php

namespace App\Livewire\Website\Components;

use App\Models\OnlineCourse as ModelsOnlineCourse;
use Livewire\Component;

class OnlineCourse extends Component
{
    public $onlineCourses = [];

    public function mount()
    {
        $this->onlineCourses = ModelsOnlineCourse::list()->get();
    }

        public function toLogin()
    {
        if (authCheck() && authUser()->otp_verified && authUser()->forgot_password_otp == '') {
            return redirect()->route('user.organization.organizations');
        }else {
            return redirect()->route('user.login');
        }
    }

    public function render()
    {
        return view('livewire.website.components.online-course');
    }
}
