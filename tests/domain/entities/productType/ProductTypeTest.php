<?php
namespace domain\entities\productType;

use PHPUnit\Framework\TestCase;
use workanaSoftexpert\domain\entities\productType\ProductType;
use workanaSoftexpert\domain\entities\user\User;

class ProductTypeTest extends TestCase
{
    private $productType;

    protected function setUp(): void
    {
        $this->productType = new ProductType();
    }

    public function testCreateProductType()
    {
        $this->productType->setName("Electronic");
        $this->productType->setTaxPercentage(20.0);
        $this->productType->setExcluded(false);

        $this->assertEquals("Electronic", $this->productType->getName());
        $this->assertEquals(20.0, $this->productType->getTaxPercentage());
        $this->assertFalse($this->productType->isExcluded());
    }

    public function testSetAndGetName()
    {
        $this->productType->setName("Furniture");
        $this->assertEquals("Furniture", $this->productType->getName());
    }

    public function testSetAndGetTaxPercentage()
    {
        $this->productType->setTaxPercentage(15.0);
        $this->assertEquals(15.0, $this->productType->getTaxPercentage());
    }

    public function testSetAndGetExcluded()
    {
        $this->productType->setExcluded(true);
        $this->assertTrue($this->productType->isExcluded());

        $this->productType->setExcluded(false);
        $this->assertFalse($this->productType->isExcluded());
    }

    public function testSetAndGetCreatedByUser()
    {
        $user = $this->createMock(User::class);
        $this->productType->setCreatedByUser($user);
        $this->assertSame($user, $this->productType->getCreatedByUser());
    }
}