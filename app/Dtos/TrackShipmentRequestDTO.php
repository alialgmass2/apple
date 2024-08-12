<?php

namespace App\Dtos;

class TrackShipmentRequestDTO
{
    public function __construct(

        public array $shipments
    ) {}
}
