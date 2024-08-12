<?php

namespace App\Livewire\Website\Components;

use App\Models\ITContactUs;
use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class ITContact extends Component
{

    public $state = [];
    public $isModalContactShow = false;

    public function render()
    {
        $roles = Role::listDropdown()->get();
        return view('livewire.website.components.i-t-contact', [
            'roles' => $roles,
        ]);
    }

    public function openContactModal()
    {
        $this->isModalContactShow = true;
    }

    public function sendMessage()
    {
        Validator::make($this->state, [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150',
            'role_id' => 'required|integer|exists:roles,id',
            'institution' => 'required|string|max:150',
            'phone' => 'nullable|string|max:150',
            'message' => 'required|string',
        ])->validate();
        ITContactUs::create([
            'role_id' => $this->state['role_id'],
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'institution' => $this->state['institution'],
            'phone' => toExists('phone',$this->state) ? $this->state['phone'] : '',
            'message' => $this->state['message'],
        ]);
        session()->flash('success', 'Message has been sent successfully');
        $this->reset('state');
    }

}
