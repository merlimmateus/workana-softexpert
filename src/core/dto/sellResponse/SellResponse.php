<?php
namespace workanaSoftexpert\core\dto\sellResponse;

use workanaSoftexpert\domain\entities\sell\Sell;

class SellResponse {
    public $id;
    public $productId;

    public $name;
    public $quantity;
    public $totalValue;
    public $totalTax;
    public $createdAt;
    public $itemValue;
    public $itemTax;
    public $purchaseTotal;
    public $taxTotal;
    public $productName;
    public $productPrice;

    public $excluded;

    public function __construct(Sell $sell) {
        $product = $sell->getProduct();
        $this->id = $sell->getId();
        $this->productId = $product->getId();
        $this->name = $sell->getName();
        $this->quantity = $sell->getQuantity();
        $this->totalValue = $product->getPrice() * $this->quantity;
        $this->totalTax = $product->calculateTax() * $this->quantity;
        $this->createdAt = $sell->getCreatedAt()->format('Y-m-d H:i:s');
        $this->itemValue = $product->getPrice();
        $this->itemTax = $product->calculateTax();
        $this->purchaseTotal = $this->totalValue + $this->totalTax;
        $this->taxTotal = $this->totalTax;
        $this->productName = $product->getName();
        $this->productPrice = $product->getPrice();
        $this->excluded = $sell->isExcluded();
    }
}