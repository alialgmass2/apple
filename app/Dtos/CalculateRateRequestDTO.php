<?php

namespace App\Dtos;

class CalculateRateRequestDTO
{
    public function __construct(

        public string  $originCity,
        public string  $originCountryCode,
        public string  $destinationCity,
        public string  $destinationCountryCode,
        public float   $weight,
        public string  $weightUnit,
        public string  $productGroup,
        public string  $productType,
        public string  $paymentType,
        public ?string $currencyCode = 'SAR',
        public ?int    $numberOfPieces = 1
    )
    {
    }


}
