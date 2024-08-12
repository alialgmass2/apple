<?php

namespace App\Livewire\Website\Components;

use App\Models\OnlineCourse as ModelsOnlineCourse;
use Livewire\Component;

class Offers extends Component
{
    public $organizations ;
    public function render()
    {
        $this->organizations = auth()->user()->organization->offers()->with('offer')->whereHas('offer',function ($sOffer){
            $sOffer->where([['start_date','<=',\Carbon\Carbon::parse(now())],['end_date','>=',\Carbon\Carbon::parse(now())],['status',1]]);
        })->get()??[];
        return view('livewire.website.components.offers');
    }
}
