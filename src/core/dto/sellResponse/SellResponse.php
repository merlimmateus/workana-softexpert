<?php
namespace workanaSoftexpert\core\dto\sellResponse;

use workanaSoftexpert\domain\entities\sell\Sell;

class SellResponse {
    public $id;
    public $productId;
    public $quantity;
    public $totalValue;
    public $totalTax;
    public $createdAt;

    public function __construct(Sell $sell) {
        $this->id = $sell->getId();
        $this->productId = $sell->getProduct()->getId();
        $this->quantity = $sell->getQuantity();
        $this->totalValue = $sell->getProduct()->getPrice() * $sell->getQuantity();
        $this->totalTax = $sell->getProduct()->calculateTax() * $sell->getQuantity();
        $this->createdAt = $sell->getCreatedAt()->format('Y-m-d H:i:s');
    }
}