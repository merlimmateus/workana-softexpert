<?php
namespace workanaSoftexpert\core\dto\productCreateRequest;

class ProductCreateRequest {

    public $name;
    public $price;
    public $productTypeId;
    public $createdByUserId;

    public function __construct($data) {
        $this->name = $data['name'] ?? null;
        $this->price = $data['price'] ?? null;
        $this->productTypeId = $data['productTypeId'] ?? null;
        $this->createdByUserId = $data['createdByUserId'] ?? null;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getProductTypeId()
    {
        return $this->productTypeId;
    }

    public function setProductTypeId($productTypeId)
    {
        $this->productTypeId = $productTypeId;
    }

    public function getCreatedByUserId()
    {
        return $this->createdByUserId;
    }

    public function setCreatedByUserId($createdByUserId)
    {
        $this->createdByUserId = $createdByUserId;
    }

}
