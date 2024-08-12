<?php

namespace App\Dtos;

class ShipmentDTO
{
    public $reference1;
    public $reference2;
    public $reference3;
    public $shipper;
    public $consignee;
    public $thirdParty;
    public $shippingDateTime;
    public $dueDate;
    public $comments;
    public $pickupLocation;
    public $operationsInstructions;
    public $accountingInstructions;
    public $details;
    public $labelInfo;

    public function __construct($data)
    {
        $this->reference1 = $data['reference1'];
        $this->reference2 = $data['reference2'];
        $this->reference3 = $data['reference3'];
        $this->shipper = $data['shipper'];
        $this->consignee = $data['consignee'];
        $this->thirdParty = $data['thirdParty'];
        $this->shippingDateTime = $data['shippingDateTime'];
        $this->dueDate = $data['dueDate'];
        $this->comments = $data['comments'];
        $this->pickupLocation = $data['pickupLocation'];
        $this->operationsInstructions = $data['operationsInstructions'];
        $this->accountingInstructions = $data['accountingInstructions'];
        $this->details = $data['details'];
        $this->labelInfo = $data['labelInfo'];
    }
}
