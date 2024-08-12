<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Dtos\CalculateRateRequestDTO;
use App\Dtos\FetchCitiesRequestDTO;
use App\Dtos\CreatePickupRequestDTO;
use App\Dtos\TrackShipmentRequestDTO;

class AramexService
{
    protected string $baseUrl = 'https://ws.sbx.aramex.net/ShippingAPI.V2';
    protected array $ClientInfo=[];


    public function __construct()
    {

        $this->ClientInfo = [
            'UserName' => env('ARAMEX_USERNAME','testingapi@aramex.com'),
            'Password' => env('ARAMEX_PASSWORD','R123456789$r'),
            'Version' => 'v1',
            'AccountNumber' => env('ARAMEX_ACCOUNT_NUMBER','4004636'),
            'AccountPin' => env('ARAMEX_ACCOUNT_PIN','432432'),
            'AccountEntity' => env('ARAMEX_ENTITY','RUH'),
            'AccountCountryCode' =>env('ARAMEX_COUNTRY_CODE','SA'),
            'Source' => 24,
        ];
    }


    public function calculateRate(CalculateRateRequestDTO $dto)
    {
        $url = "{$this->baseUrl}/RateCalculator/Service_1_0.svc/json/CalculateRate";

        $response = Http::post($url, [
            'ClientInfo' => $this->ClientInfo,
            'DestinationAddress' => [
                'City' => $dto->destinationCity,
                'CountryCode' => $dto->destinationCountryCode,
            ],
            'OriginAddress' => [
                'City' => $dto->originCity,
                'CountryCode' => $dto->originCountryCode,
            ],
            'PreferredCurrencyCode' => $dto->currencyCode,
            'ShipmentDetails' => [
                'ActualWeight' => [
                    'Unit' => $dto->weightUnit,
                    'Value' => $dto->weight,
                ],
                'NumberOfPieces' => $dto->numberOfPieces,
                'ProductGroup' => $dto->productGroup,
                'ProductType' => $dto->productType,
                'PaymentType' => $dto->paymentType,
            ],
        ]);

        return $response->json();
    }

    public function fetchCities(FetchCitiesRequestDTO $dto)
    {
        $url = "{$this->baseUrl}/Location/Service_1_0.svc/json/FetchCities";

        $response = Http::post($url, [
            'CountryCode' => $dto->countryCode,
            'State' => $dto->state,
            'NameStartsWith' => $dto->nameStartsWith,
            'ClientInfo' => $this->ClientInfo,
            'Transaction' => [
                'Reference1' => '001',
                'Reference2' => '002',
                'Reference3' => '003',
                'Reference4' => '004',
                'Reference5' => '005',
            ],
        ]);

        return $response->json();
    }

    public function createPickup(CreatePickupRequestDTO $dto)
    {
        $url = "{$this->baseUrl}/Shipping/Service_1_0.svc/json/CreatePickup";

        $response = Http::post($url, [
            'Pickup' => [
                'PickupAddress' => [
                    'Line1' => 'Address Line1',
                    'City' => $dto->pickupCity,
                    'CountryCode' => $dto->pickupCountryCode,
                ],
                'PickupContact' => [
                    'PersonName' => $dto->pickupPersonName,
                    'PhoneNumber1' => $dto->pickupPhoneNumber,
                    'EmailAddress' => $dto->pickupEmailAddress,
                ],
                'PickupLocation' => $dto->pickupLocation,
                'PickupDate' => $dto->pickupDate,
                'ReadyTime' => $dto->readyTime,
                'LastPickupTime' => $dto->lastPickupTime,
                'Vehicle' => $dto->vehicle,
                'PickupItems' => [
                    [
                        'ProductGroup' => $dto->productGroup,
                        'ProductType' => $dto->productType,
                        'NumberOfShipments' => $dto->numberOfShipments,
                        'ShipmentWeight' => [
                            'Unit' => $dto->weightUnit,
                            'Value' => $dto->shipmentWeight,
                        ],
                    ],
                ],
            ],
            'ClientInfo' => $this->ClientInfo,
        ]);

        return $response->json();
    }

    public function trackShipments(TrackShipmentRequestDTO $dto)
    {
        $url = "{$this->baseUrl}/Tracking/Service_1_0.svc/json/TrackShipments";

        $response = Http::post($url, [
            'ClientInfo' => $this->ClientInfo,
            'GetLastTrackingUpdateOnly' => true,
            'Shipments' => $dto->shipments,
        ]);

        return $response->json();
    }
}
