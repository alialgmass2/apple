<?php

namespace App\Traits;

use Livewire\Attributes\Locked;

trait HasModal
{
    #[Locked]
    public $isModalShow = false;
    #[Locked]
    public $isEditMode = false;
    #[Locked]
    public $isModalHeader = false;
    #[Locked]
    public $editId;

    // SHOW MODAL
    public function showModal()
    {
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = true;
        $this->isModalHeader = false;
    }
    // SHOW MODAL
    public function isModalHeader()
    {
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
        $this->isModalHeader = true;
    }


    // CLOSE MODAL
    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
        $this->isModalHeader = false;
    }
}
