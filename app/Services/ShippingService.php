<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;

class ShippingService
{

    protected $username;
    protected $password;
    protected $accountNumber;
    protected $accountPin;
    protected $entity;
    protected $countryCode;

    public function __construct()
    {


        $this->username = env('ARAMEX_USERNAME','testingapi@aramex.com');
        $this->password = env('ARAMEX_PASSWORD','R123456789$r');
        $this->accountNumber = env('ARAMEX_ACCOUNT_NUMBER','4004636');
        $this->accountPin = env('ARAMEX_ACCOUNT_PIN','432432');
        $this->entity = env('ARAMEX_ENTITY','RUH');
        $this->countryCode = env('ARAMEX_COUNTRY_CODE','SA');
    }
    public function createPickup()
    {
        $userName = 'testingapi@aramex.com';
        $password = 'R123456789$r';
        $accountNumber = '4004636';
        $accountPin = '432432';
        $accountEntity = 'RUH';
        $accountCountryCode = 'SA';
        $reference1 = 'AAA';
        $reference2 = 'BBB';
        $reference3 = 'CCC';
        $source = '24';
        $line1 = 'Test';
        $city = 'Abqaiq';
        $countryCode = 'SA';
        $personName = 'test';
        $companyName = 'test';
        $phoneNumber1 = '05123456789';
        $cellPhone = '05123456789';
        $emailAddress = 'test@test.com';
        $pickupLocation = 'test';
        $pickupDate = '2024-08-11T15:55:24';
        $readyTime = '2024-08-12T13:55:24';
        $lastPickupTime = '2024-08-10T15:55:24';
        $closingTime = '2024-08-17T17:55:24';
        $reference1 = '001';
        $productGroup = 'EXP';
        $productType = 'PDX';
        $numberOfShipments = 1;
        $packageType = 'Box';
        $payment = 'P';
        $shipmentWeightUnit = 'KG';
        $shipmentWeightValue = 0.5;
        $shipmentVolumeUnit = 'CM3';
        $shipmentVolumeValue = 10;
        $numberOfPieces = 1;
        $status = 'Ready';

        $xmlPayload = <<<XML
<?xml version="1.0"?>
<PickupCreationRequest xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://ws.aramex.net/ShippingAPI/v1/">
  <ClientInfo>
    <UserName>{$userName}</UserName>
    <Password>{$password}</Password>
    <Version>v1</Version>
    <AccountNumber>{$accountNumber}</AccountNumber>
    <AccountPin>{$accountPin}</AccountPin>
    <AccountEntity>{$accountEntity}</AccountEntity>
    <AccountCountryCode>{$accountCountryCode}</AccountCountryCode>
    <Source>{$source}</Source>
  </ClientInfo>
  <Transaction>
    <Reference1 />
    <Reference2 />
    <Reference3 />
    <Reference4 />
    <Reference5 />
  </Transaction>
  <Pickup>
    <PickupAddress>
      <Line1>{$line1}</Line1>
      <Line2 />
      <Line3 />
      <City>{$city}</City>
      <StateOrProvinceCode />
      <PostCode />
      <CountryCode>{$countryCode}</CountryCode>
      <Longitude>0</Longitude>
      <Latitude>0</Latitude>
    </PickupAddress>
    <PickupContact>
      <Department />
      <PersonName>{$personName}</PersonName>
      <Title />
      <CompanyName>{$companyName}</CompanyName>
      <PhoneNumber1>{$phoneNumber1}</PhoneNumber1>
      <PhoneNumber1Ext />
      <PhoneNumber2 />
      <PhoneNumber2Ext />
      <FaxNumber />
      <CellPhone>{$cellPhone}</CellPhone>
      <EmailAddress>{$emailAddress}</EmailAddress>
      <Type />
    </PickupContact>
    <PickupLocation>{$pickupLocation}</PickupLocation>
    <PickupDate>{$pickupDate}</PickupDate>
    <ReadyTime>{$readyTime}</ReadyTime>
    <LastPickupTime>{$lastPickupTime}</LastPickupTime>
    <ClosingTime>{$closingTime}</ClosingTime>
    <Comments />
    <Reference1>{$reference1}</Reference1>
    <Reference2 />
    <Vehicle />
    <PickupItems>
      <PickupItemDetail>
        <ProductGroup>{$productGroup}</ProductGroup>
        <ProductType>{$productType}</ProductType>
        <NumberOfShipments>{$numberOfShipments}</NumberOfShipments>
        <PackageType>{$packageType}</PackageType>
        <Payment>{$payment}</Payment>
        <ShipmentWeight>
          <Unit>{$shipmentWeightUnit}</Unit>
          <Value>{$shipmentWeightValue}</Value>
        </ShipmentWeight>
        <ShipmentVolume>
          <Unit>{$shipmentVolumeUnit}</Unit>
          <Value>{$shipmentVolumeValue}</Value>
        </ShipmentVolume>
        <NumberOfPieces>{$numberOfPieces}</NumberOfPieces>
        <CashAmount>
          <CurrencyCode></CurrencyCode>
          <Value>0</Value>
        </CashAmount>
        <ExtraCharges>
          <CurrencyCode></CurrencyCode>
          <Value>0</Value>
        </ExtraCharges>
        <ShipmentDimensions>
          <Length>0</Length>
          <Width>0</Width>
          <Height>0</Height>
          <Unit />
        </ShipmentDimensions>
        <Comments />
      </PickupItemDetail>
    </PickupItems>
    <Status>{$status}</Status>
    <Branch />
    <RouteCode />
  </Pickup>
</PickupCreationRequest>
XML;

        $response = Http::withHeaders([
            'Content-Type' => 'application/xml',

        ])
            ->withBody($xmlPayload, 'application/xml')
            ->post('https://ws.sbx.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/xml/CreatePickup');
        $xmlResponse = $response->body();
        $xmlObject = simplexml_load_string($xmlResponse);

// Convert SimpleXMLElement object to JSON string
        $jsonString = json_encode($xmlObject);

// Convert JSON string to associative array
        $jsonArray = json_decode($jsonString, true);
        return  $jsonArray;

    }
}
