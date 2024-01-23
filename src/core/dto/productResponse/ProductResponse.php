<?php
namespace workanaSoftexpert\core\dto\productResponse;

class ProductResponse {
    public $id;

    public $name;
    public $price;
    public $productTypeId;
    public $createdAt;
    public $updatedAt;
    public $createdByUserId;

    public function __construct($product) {
        $this->id = $product->getId();
        $this->name = $product->getName();
        $this->price = $product->getPrice();
        $this->productTypeId = $product->getProductType()->getId();
        $this->createdAt = $product->getCreatedAt()->format('Y-m-d H:i:s');
        $this->updatedAt = $product->getUpdatedAt() ? $product->getUpdatedAt()->format('Y-m-d H:i:s') : null;
        $this->createdByUserId = $product->getCreatedByUser()->getId();
    }

}
