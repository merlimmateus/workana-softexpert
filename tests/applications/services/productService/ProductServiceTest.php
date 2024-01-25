<?php
namespace applications\services\productService;

use PHPUnit\Framework\TestCase;
use workanaSoftexpert\applications\services\productService\ProductService;
use workanaSoftexpert\domain\repositories\productRepository\ProductRepository;
use workanaSoftexpert\domain\repositories\productTypeRepository\ProductTypeRepository;
use workanaSoftexpert\domain\repositories\userRepository\UserRepository;
use workanaSoftexpert\core\dto\productCreateRequest\ProductCreateRequest;
use workanaSoftexpert\domain\entities\product\Product;
use workanaSoftexpert\domain\entities\productType\ProductType;
use workanaSoftexpert\domain\entities\user\User;

class ProductServiceTest extends TestCase
{
    private $productService;
    private $productRepository;
    private $productTypeRepository;
    private $userRepository;

    protected function setUp(): void
    {
        $this->productRepository = $this->createMock(ProductRepository::class);
        $this->productTypeRepository = $this->createMock(ProductTypeRepository::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->productService = new ProductService(
            $this->productRepository,
            $this->productTypeRepository,
            $this->userRepository
        );
    }

    public function testCreateProduct()
    {
        $productType = $this->createMock(ProductType::class);
        $user = $this->createMock(User::class);

        $this->productTypeRepository->method('find')
            ->willReturn($productType);
        $this->userRepository->method('find')
            ->willReturn($user);

        $requestData = [
            'name' => "Test Product",
            'price' => 100.0,
            'productTypeId' => 1,
            'createdByUserId' => 1
        ];
        $request = new ProductCreateRequest($requestData);

        $this->productRepository->method('save')
            ->willReturn(null);

        $product = $this->productService->createProduct($request);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals("Test Product", $product->getName());
        $this->assertEquals(100.0, $product->getPrice());
        $this->assertSame($productType, $product->getProductType());
        $this->assertSame($user, $product->getCreatedByUser());
    }

    public function testDeleteProduct()
    {
        $product = $this->createMock(Product::class);
        $this->productRepository->method('find')->willReturn($product);
        $product->expects($this->once())->method('setExcluded')->with($this->equalTo(true));

        $this->productService->deleteProduct(1);
    }

    public function testGetProductById()
    {
        $product = $this->createMock(Product::class);
        $this->productRepository->method('find')->willReturn($product);

        $retrievedProduct = $this->productService->getProductById(1);
        $this->assertSame($product, $retrievedProduct);
    }

    public function testGetAllProducts()
    {
        $products = [
            $this->createMock(Product::class),
            $this->createMock(Product::class)
        ];
        $this->productRepository->method('findAll')->willReturn($products);

        $retrievedProducts = $this->productService->getAllProducts();
        $this->assertSame($products, $retrievedProducts);
    }
}