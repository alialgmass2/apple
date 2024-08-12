<?php

namespace App\Dtos;

class TabbyTransactionDTO
{

    public string $id;
    public ?array $buyer;
    public ?array $shipping_address;
    public float $amount;
    public string $currency;
    public ?string $description;
    public string $merchantTransactionId;
    public string $status;
    public string $created_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->amount = (float)$data['amount'];
        $this->currency = $data['currency'];
        $this->description = $data['description'];
        $this->status = $data['status'];
//        $this->merchantTransactionId = $data['merchantTransactionId'];
        $this->buyer = (array)$data['buyer'];
        $this->shipping_address = (array)$data['shipping_address'];
        $this->created_at = $data['created_at'];
    }

}
