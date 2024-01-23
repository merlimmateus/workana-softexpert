<?php
namespace YourNamespace\core\dto\ProductCreateRequest;

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

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed|null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed|null $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed|null
     */
    public function getProductTypeId()
    {
        return $this->productTypeId;
    }

    /**
     * @param mixed|null $productTypeId
     */
    public function setProductTypeId($productTypeId)
    {
        $this->productTypeId = $productTypeId;
    }

    /**
     * @return mixed|null
     */
    public function getCreatedByUserId()
    {
        return $this->createdByUserId;
    }

    /**
     * @param mixed|null $createdByUserId
     */
    public function setCreatedByUserId($createdByUserId)
    {
        $this->createdByUserId = $createdByUserId;
    }


}
