<?php

namespace App\Dtos;

class FetchCitiesRequestDTO
{
    public function __construct(

        public ?string $state = null,
        public ?string $nameStartsWith = null,

    ) {}
}
