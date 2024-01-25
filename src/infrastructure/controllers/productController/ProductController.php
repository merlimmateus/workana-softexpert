<?php
namespace workanaSoftexpert\infrastructure\controllers\productController;

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

    public function createProduct($request)
    {
        try {
            $productCreateRequest = new ProductCreateRequest($request);
            $product = $this->productService->createProduct($productCreateRequest);
            return json_encode(new ProductResponse($product));
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode(['error' => 'Error creating product', 'details' => $e->getMessage()]);
        }
    }

    public function updateProduct($request, $productId)
    {
        try {
            $productCreateRequest = new ProductCreateRequest($request);
            $this->productService->updateProduct($productId, $productCreateRequest);

            $updatedProduct = $this->productService->getProductById($productId);
            return json_encode(new ProductResponse($updatedProduct));
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode(['error' => 'Error updating product', 'details' => $e->getMessage()]);
        }
    }

    public function deleteProduct($productId)
    {
        try {
            $this->productService->deleteProduct($productId);
            return json_encode(['message' => 'Product successfully marked as deleted']);
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode(['error' => 'Error deleting product', 'details' => $e->getMessage()]);
        }
    }

    public function getAllProducts()
    {
        try {
            $products = $this->productService->getAllProducts();
            return json_encode(array_map(function($product) {
                return new ProductResponse($product);
            }, $products));
        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode(['error' => 'Error fetching products', 'details' => $e->getMessage()]);
        }
    }
}
