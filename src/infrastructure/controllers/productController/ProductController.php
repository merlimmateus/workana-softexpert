<?php
namespace workanaSoftexpert\infrastructure\controllers\productController;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use workanaSoftexpert\applications\services\productService\ProductService;
use workanaSoftexpert\core\dto\productCreateRequest\ProductCreateRequest;
use workanaSoftexpert\core\dto\productResponse\ProductResponse;

class ProductController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function createProduct($request)
    {
        $productCreateRequest = new ProductCreateRequest($request);
        $product = $this->productService->createProduct($productCreateRequest);
        return json_encode(new ProductResponse($product));
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function updateProduct($request, $productId)
    {
        $productCreateRequest = new ProductCreateRequest($request);
        $this->productService->updateProduct($productId, $productCreateRequest);

        $updatedProduct = $this->productService->getProductById($productId);
        return json_encode(new ProductResponse($updatedProduct));
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function deleteProduct($productId)
    {
        $this->productService->deleteProduct($productId);
        return json_encode(['message' => 'Product successfully marked as deleted']);
    }

    public function getAllProducts() {
        $products = $this->productService->getAllProducts();
        return json_encode(array_map(function($product) {
            return new ProductResponse($product);
        }, $products));
    }
}
