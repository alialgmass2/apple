<?php
namespace App\Traits;

trait Translate
{

    public function translate($property)
    {
        if ($property !== null) {
            return $this->{$property . '_' . app()->getLocale()} ?? '';
        }
        return '';
    }

}
