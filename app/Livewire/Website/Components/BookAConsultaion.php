<?php

namespace App\Livewire\Website\Components;

use App\Models\Role;
use Livewire\Component;
use App\Models\BookAConsulation;
use App\Models\BookConsultation;
use Illuminate\Support\Facades\Validator;

class BookAConsultaion extends Component
{
    public $state = [];
    public $isModalContactShow = false;
    public $bookConsultation;

    public function render()
    {
        $roles = Role::listDropdown()->get();
        $this->bookConsultation = BookConsultation::list()->first();
        return view('livewire.website.components.book-a-consultaion', [
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

        BookAConsulation::create([
            'role_id' => $this->state['role_id'],
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'institution' => $this->state['institution'],
            'phone' => toExists('phone', $this->state) ? $this->state['phone'] : '',
            'message' => $this->state['message'],
        ]);
        session()->flash('success', __('app.message_sent_successfully'));

        $this->reset('state');
    }
}
