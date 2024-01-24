<?php
namespace workanaSoftexpert\core\dto\productTypeResponse;

class ProductTypeResponse {

    public $id;

    public $name;
    public $taxPercentage;
    public $createdByUserId;
    public $excluded;

    public function __construct($productType) {
        $this->id = $productType->getId();
        $this->name = $productType->getName();
        $this->taxPercentage = $productType->getTaxPercentage();
        $this->createdByUserId = $productType->getCreatedByUser()->getId();
        $this->excluded = $productType->isExcluded();
    }

}
