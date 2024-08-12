<?php

namespace App\Traits;

use Livewire\Attributes\Locked;
use Livewire\Attributes\On;

trait HasModalWebsite
{
    #[Locked]
    public $isModalShow = false;
    #[Locked]
    public $isModalShowMailExists = false;

    // SHOW MODAL
    #[On('open-modal')]
    public function showModal()
    {
        $this->isModalShow = true;
    }
    // SHOW MODAL
    #[On('open-modal-mail-exists')]
    public function isModalShowMailExists()
    {
        $this->isModalShowMailExists = true;
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->isModalShow = false;
        $this->isModalShowMailExists = false;
    }
    // CLOSE MODAL EXISTS EMAIL
    public function closeModalMailExists()
    {
        $this->isModalShow = false;
        $this->isModalShowMailExists = false;
    }
}
