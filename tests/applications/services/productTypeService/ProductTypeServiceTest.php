<?php
namespace applications\services\productTypeService;

use PHPUnit\Framework\TestCase;
use workanaSoftexpert\applications\services\productTypeService\ProductTypeService;
use workanaSoftexpert\core\dto\productTypeCreateRequest\ProductTypeCreateRequest;
use workanaSoftexpert\domain\entities\productType\ProductType;
use workanaSoftexpert\domain\entities\user\User;
use workanaSoftexpert\domain\repositories\productTypeRepository\ProductTypeRepository;
use workanaSoftexpert\domain\repositories\userRepository\UserRepository;

class ProductTypeServiceTest extends TestCase
{
    private $productTypeService;
    private $productTypeRepository;
    private $userRepository;

    protected function setUp(): void
    {
        $this->productTypeRepository = $this->createMock(ProductTypeRepository::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->productTypeService = new ProductTypeService(
            $this->productTypeRepository,
            $this->userRepository
        );
    }

    public function testCreateProductType()
    {
        $user = $this->createMock(User::class);
        $this->userRepository->method('find')->willReturn($user);

        $requestData = [
            'name' => "New Product Type",
            'taxPercentage' => 10.0,
            'createdByUserId' => 1
        ];
        $request = new ProductTypeCreateRequest($requestData);

        $productType = $this->productTypeService->createProductType($request);

        $this->assertInstanceOf(ProductType::class, $productType);
        $this->assertEquals("New Product Type", $productType->getName());
        $this->assertEquals(10.0, $productType->getTaxPercentage());
        $this->assertSame($user, $productType->getCreatedByUser());
    }

    public function testUpdateProductType()
    {
        $productType = $this->createMock(ProductType::class);
        $this->productTypeRepository->method('find')->willReturn($productType);

        $updatedData = ['name' => "Updated Product Type", 'taxPercentage' => 15.0];
        $productType->expects($this->once())->method('setName')->with($this->equalTo("Updated Product Type"));
        $productType->expects($this->once())->method('setTaxPercentage')->with($this->equalTo(15.0));

        $this->productTypeService->updateProductType(1, $updatedData);
    }

    public function testDeleteProductType()
    {
        $productType = $this->createMock(ProductType::class);
        $this->productTypeRepository->method('find')->willReturn($productType);
        $productType->expects($this->once())->method('setExcluded')->with($this->equalTo(true));

        $this->productTypeService->deleteProductType(1);
    }

    public function testGetAllProductTypes()
    {
        $productTypes = [
            $this->createMock(ProductType::class),
            $this->createMock(ProductType::class)
        ];
        $this->productTypeRepository->method('findAll')->willReturn($productTypes);

        $retrievedProductTypes = $this->productTypeService->getAllProductTypes();
        $this->assertSame($productTypes, $retrievedProductTypes);
    }
}