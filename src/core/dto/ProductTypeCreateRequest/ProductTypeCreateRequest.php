<?php
namespace YourNamespace\core\dto\ProductTypeCreateRequest;

class ProductTypeCreateRequest {

    public $name;
    public $taxPercentage;

    public function __construct($data) {
        $this->name = $data['name'] ?? null;
        $this->taxPercentage = $data['taxPercentage'] ?? null;
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
    public function getTaxPercentage()
    {
        return $this->taxPercentage;
    }

    /**
     * @param mixed|null $taxPercentage
     */
    public function setTaxPercentage($taxPercentage)
    {
        $this->taxPercentage = $taxPercentage;
    }

}
