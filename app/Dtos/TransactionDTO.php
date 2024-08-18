<?php

namespace App\Dtos;

class TransactionDTO
{

    public ?string $id =null;
    public ?string $paymentType =null;
    public ?string $paymentBrand =null;
    public ?float $amount =null;
    public ?string $currency =null;
    public ?string $descriptor =null;
    public ?string $merchantTransactionId =null;
    public ?array $result =[];
    public ?array $resultDetails =[];
    public ?array $card =[];
    public ?array $customer =[];
    public ?array $billing =[];
    public ?array $customParameters =[];
    public ?array $risk =[];
    public ?string $timestamp =null;
    public $data=[];

    public function __construct(array $data)
    {
        foreach (array_keys($data) as $key=>$value){
            $this->{$value} = $data[$value];
        }
        $this->data= $data;
//        $this->id = $data['id'];
//        $this->paymentType = $data['paymentType'];
//        $this->paymentBrand = $data['paymentBrand'];
//        $this->amount = (float) isset($data['amount']) ?$data['amount'] : null;
//        $this->currency = $data['currency'];
//        $this->descriptor = $data['descriptor'];
//        $this->merchantTransactionId = $data['merchantTransactionId'];
//        $this->result = (array)$data['result'];
//        $this->resultDetails = (array)$data['resultDetails'];
//        $this->card = (array)$data['card'];
//        $this->customer = (array)$data['customer'];
//        $this->billing = (array)$data['billing'];
//        $this->customParameters = (array)$data['customParameters'];
//        $this->risk = (array)$data['risk'];
//        $this->timestamp = $data['timestamp'];
    }


}
