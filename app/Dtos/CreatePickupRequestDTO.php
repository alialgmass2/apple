<?php

namespace App\Dtos;

class CreatePickupRequestDTO
{
    public function __construct(

        public string $pickupLocation,
        public string $pickupCity,
        public string $pickupCountryCode,
        public string $pickupPersonName,
        public string $pickupPhoneNumber,
        public string $pickupEmailAddress,
        public string $pickupDate,
        public string $readyTime,
        public string $lastPickupTime,
        public ?string $vehicle = 'van',
        public int $numberOfShipments = 1,
        public float $shipmentWeight = 1.0,
        public string $weightUnit = 'KG',
        public string $productGroup = 'DOM',
        public string $productType = 'CDS'
    ) {}
}
