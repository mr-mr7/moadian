<?php

namespace Jooyeshgar\Moadian;

use Ramsey\Uuid\Uuid;

class Invoice
{
    private InvoiceHeader $header;
    private array $body = [];
    private array $payments = [];
    private string $uid;

    public $retry = false;
    
    public function __construct(InvoiceHeader $header)
    {
        $this->header = $header;
    }

    public function addItem(InvoiceItem $item)
    {
        $this->body[] = $item;
    }

    public function addPayment(Payment $payment)
    {
        $this->payments[] = $payment;
    }

    public function setUid(string $uid)
    {
        $this->uid = $uid;
    }

    public function getUid()
    {
        $this->uid = $this->uid ?? Uuid::uuid4()->toString();
        return $this->uid;
    }

    public function toArray()
    {
        return [
            'header'  => $this->header->toArray(),

            'body'    => array_map(function ($item){
                return $item->toArray();
            }, $this->body),

            'payments' => array_map(function ($item){
                return $item->toArray();
            }, $this->payments),
        ];
    }
}