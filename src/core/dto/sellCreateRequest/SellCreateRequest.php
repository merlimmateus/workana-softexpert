<?php
namespace workanaSoftexpert\core\dto\sellCreateRequest;

class SellCreateRequest {
    public $productId;
    public $quantity;
    public $createdByUserId;

    public $name;

    public function __construct($data) {
        $this->productId = $data['productId'] ?? null;
        $this->quantity = $data['quantity'] ?? null;
        $this->createdByUserId = $data['createdByUserId'] ?? null;
        $this->name = $data['name'];
    }
}