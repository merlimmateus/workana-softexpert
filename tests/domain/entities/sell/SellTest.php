<?php
namespace domain\entities\sell;

use DateTime;
use PHPUnit\Framework\TestCase;
use workanaSoftexpert\domain\entities\product\Product;
use workanaSoftexpert\domain\entities\sell\Sell;
use workanaSoftexpert\domain\entities\user\User;

class SellTest extends TestCase
{

    private $sell;
    private $product;
    private $user;

    protected function setUp(): void
    {
        $this->sell = new Sell();
        $this->product = $this->createMock(Product::class);
        $this->user = $this->createMock(User::class);
    }

    public function testCreateSell()
    {
        $this->sell->setProduct($this->product);
        $this->sell->setQuantity(3);
        $this->sell->setCreatedByUser($this->user);
        $this->sell->setName("Sell 1");
        $this->sell->setExcluded(false);

        $this->assertSame($this->product, $this->sell->getProduct());
        $this->assertEquals(3, $this->sell->getQuantity());
        $this->assertSame($this->user, $this->sell->getCreatedByUser());
        $this->assertEquals("Sell 1", $this->sell->getName());
        $this->assertFalse($this->sell->isExcluded());
    }

    public function testSetAndGetProduct()
    {
        $this->sell->setProduct($this->product);
        $this->assertSame($this->product, $this->sell->getProduct());
    }

    public function testSetAndGetQuantity()
    {
        $this->sell->setQuantity(5);
        $this->assertEquals(5, $this->sell->getQuantity());
    }

    public function testSetAndGetCreatedByUser()
    {
        $this->sell->setCreatedByUser($this->user);
        $this->assertSame($this->user, $this->sell->getCreatedByUser());
    }

    public function testSetAndGetName()
    {
        $this->sell->setName("New Sell");
        $this->assertEquals("New Sell", $this->sell->getName());
    }

    public function testSetAndGetExcluded()
    {
        $this->sell->setExcluded(true);
        $this->assertTrue($this->sell->isExcluded());

        $this->sell->setExcluded(false);
        $this->assertFalse($this->sell->isExcluded());
    }

    public function testSetAndGetCreatedAt()
    {
        $date = new DateTime();
        $this->sell->setCreatedAt($date);
        $this->assertEquals($date, $this->sell->getCreatedAt());
    }
}