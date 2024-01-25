<?php

namespace domain\entities\product;

use DateTime;
use PHPUnit\Framework\TestCase;
use workanaSoftexpert\domain\entities\product\Product;
use workanaSoftexpert\domain\entities\productType\ProductType;

class ProductTest extends TestCase
{
    private $product;
    private $productType;

    protected function setUp(): void
    {
        $this->product = new Product();
        $this->productType = $this->createMock(ProductType::class);
        $this->productType->method('getTaxPercentage')->willReturn(15.0);
    }

    public function testCreateProduct()
    {
        $this->product->setName("Test Product");
        $this->product->setPrice(200.0);
        $this->product->setProductType($this->productType);
        $this->product->setExcluded(false);

        $this->assertEquals("Test Product", $this->product->getName());
        $this->assertEquals(200.0, $this->product->getPrice());
        $this->assertEquals($this->productType, $this->product->getProductType());
        $this->assertFalse($this->product->isExcluded());
    }

    public function testCalculateTax()
    {
        $this->product->setPrice(100.0);
        $this->product->setProductType($this->productType);

        $tax = $this->product->calculateTax();
        $this->assertEquals(15.0, $tax);
    }

    public function testCalculateTaxWithNoProductType()
    {
        $this->product->setPrice(100.0);
        $this->product->setProductType(null);

        $tax = $this->product->calculateTax();
        $this->assertEquals(0.0, $tax);
    }

    public function testUpdateProductDetails()
    {
        $this->product->setName("Original Name");
        $this->product->setPrice(100.0);

        $this->product->setName("Updated Name");
        $this->product->setPrice(150.0);

        $this->assertEquals("Updated Name", $this->product->getName());
        $this->assertEquals(150.0, $this->product->getPrice());
    }

    public function testSetAndGetCreatedAt()
    {
        $date = new DateTime();
        $this->product->setCreatedAt($date);

        $this->assertEquals($date, $this->product->getCreatedAt());
    }

    public function testSetAndGetUpdatedAt()
    {
        $date = new DateTime();
        $this->product->setUpdatedAt($date);

        $this->assertEquals($date, $this->product->getUpdatedAt());
    }
}
