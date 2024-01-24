<?php
namespace workanaSoftexpert\core\dto\productTypeCreateRequest;

class ProductTypeCreateRequest {
    public $name;
    public $taxPercentage;
    public $createdByUserId;

    public function __construct($data) {
        $this->name = $data['name'] ?? null;
        $this->taxPercentage = $data['taxPercentage'] ?? null;
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
