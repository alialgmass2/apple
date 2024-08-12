<?php

namespace App\Dtos;

class TransactionDTO
{

    public string $id;
    public string $paymentType;
    public string $paymentBrand;
    public float $amount;
    public string $currency;
    public ?string $descriptor;
    public string $merchantTransactionId;
    public array $result;
    public array $resultDetails;
    public array $card;
    public array $customer;
    public array $billing;
    public array $customParameters;
    public array $risk;
    public string $timestamp;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->paymentType = $data['paymentType'];
        $this->paymentBrand = $data['paymentBrand'];
        $this->amount = (float)$data['amount'];
        $this->currency = $data['currency'];
        $this->descriptor = $data['descriptor'];
        $this->merchantTransactionId = $data['merchantTransactionId'];
        $this->result = (array)$data['result'];
        $this->resultDetails = (array)$data['resultDetails'];
        $this->card = (array)$data['card'];
        $this->customer = (array)$data['customer'];
        $this->billing = (array)$data['billing'];
        $this->customParameters = (array)$data['customParameters'];
        $this->risk = (array)$data['risk'];
        $this->timestamp = $data['timestamp'];
    }


}
