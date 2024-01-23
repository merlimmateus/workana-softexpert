<?php
namespace workanaSoftexpert\core\dto\productTypeResponse;

class ProductTypeResponse {

    public $name;
    public $taxPercentage;
    public $createdByUserId;

    public function __construct($productType) {
        $this->name = $productType->getName();
        $this->taxPercentage = $productType->getTaxPercentage();
        $this->createdByUserId = $productType->getCreatedByUser()->getId();
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getTaxPercentage()
    {
        return $this->taxPercentage;
    }

    public function setTaxPercentage($taxPercentage)
    {
        $this->taxPercentage = $taxPercentage;
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
