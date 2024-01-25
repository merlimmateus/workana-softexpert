<?php

namespace applications\services\sellService;

use PHPUnit\Framework\TestCase;
use workanaSoftexpert\applications\services\sellService\SellService;
use workanaSoftexpert\core\dto\sellCreateRequest\SellCreateRequest;
use workanaSoftexpert\domain\entities\product\Product;
use workanaSoftexpert\domain\entities\sell\Sell;
use workanaSoftexpert\domain\entities\user\User;
use workanaSoftexpert\domain\repositories\productRepository\ProductRepository;
use workanaSoftexpert\domain\repositories\sellRepository\SellRepository;
use workanaSoftexpert\domain\repositories\userRepository\UserRepository;

class SellServiceTest extends TestCase
{
    private $sellService;
    private $sellRepository;
    private $productRepository;
    private $userRepository;

    protected function setUp(): void
    {
        $this->sellRepository = $this->createMock(SellRepository::class);
        $this->productRepository = $this->createMock(ProductRepository::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->sellService = new SellService(
            $this->sellRepository,
            $this->productRepository,
            $this->userRepository
        );
    }

    public function testCreateSell()
    {
        $product = $this->createMock(Product::class);
        $user = $this->createMock(User::class);
        $this->productRepository->method('find')->willReturn($product);
        $this->userRepository->method('find')->willReturn($user);

        $requestData = [
            'productId' => 1,
            'quantity' => 2,
            'name' => 'Test Sell',
            'createdByUserId' => 1
        ];
        $request = new SellCreateRequest($requestData);

        $sell = $this->sellService->createSell($request);

        $this->assertInstanceOf(Sell::class, $sell);
        $this->assertSame($product, $sell->getProduct());
        $this->assertEquals(2, $sell->getQuantity());
        $this->assertEquals('Test Sell', $sell->getName());
        $this->assertSame($user, $sell->getCreatedByUser());
    }

    public function testUpdateSell()
    {
        $sell = $this->createMock(Sell::class);
        $product = $this->createMock(Product::class);
        $this->sellRepository->method('find')->willReturn($sell);
        $this->productRepository->method('find')->willReturn($product);

        $requestData = [
            'productId' => 1,
            'quantity' => 3,
            'name' => 'Updated Sell',
            'createdByUserId' => 1
        ];
        $request = new SellCreateRequest($requestData);

        $updatedSell = $this->sellService->updateSell(1, $request);

        $this->assertInstanceOf(Sell::class, $updatedSell);
        $this->assertSame($product, $updatedSell->getProduct());
        $this->assertEquals(3, $updatedSell->getQuantity());
        $this->assertEquals('Updated Sell', $updatedSell->getName());
    }

    public function testDeleteSell()
    {
        $sell = $this->createMock(Sell::class);
        $this->sellRepository->method('find')->willReturn($sell);
        $sell->expects($this->once())->method('setExcluded')->with($this->equalTo(true));

        $this->sellService->deleteSell(1);
    }

    public function testFindAllSells()
    {
        $sells = [
            $this->createMock(Sell::class),
            $this->createMock(Sell::class)
        ];
        $this->sellRepository->method('findAll')->willReturn($sells);

        $retrievedSells = $this->sellService->findAll();
        $this->assertSame($sells, $retrievedSells);
    }
}