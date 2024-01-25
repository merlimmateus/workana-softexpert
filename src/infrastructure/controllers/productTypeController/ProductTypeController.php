<?php
namespace workanaSoftexpert\infrastructure\controllers\productTypeController;

use workanaSoftexpert\applications\services\productTypeService\ProductTypeService;
use workanaSoftexpert\core\dto\productTypeCreateRequest\ProductTypeCreateRequest;
use workanaSoftexpert\core\dto\productTypeResponse\ProductTypeResponse;

class ProductTypeController
{
    private $productTypeService;

    public function __construct(ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function createProductType($request)
    {
        try {
            $productTypeCreateRequest = new ProductTypeCreateRequest($request);
            $productType = $this->productTypeService->createProductType($productTypeCreateRequest);
            return json_encode(new ProductTypeResponse($productType));
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode(['error' => 'Error creating product type', 'details' => $e->getMessage()]);
        }
    }

    public function updateProductType($request, $productTypeId) {
        try {
            $productType = $this->productTypeService->updateProductType($productTypeId, $request);
            return json_encode(new ProductTypeResponse($productType));
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode(['error' => 'Error updating product type', 'details' => $e->getMessage()]);
        }
    }

    public function deleteProductType($productTypeId) {
        try {
            $this->productTypeService->deleteProductType($productTypeId);
            return json_encode(['message' => 'Product type successfully deleted']);
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode(['error' => 'Error deleting product type', 'details' => $e->getMessage()]);
        }
    }

    public function getAllProductTypes() {
        try {
            $productTypes = $this->productTypeService->getAllProductTypes();
            return json_encode(array_map(function($productType) {
                return new ProductTypeResponse($productType);
            }, $productTypes));
        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode(['error' => 'Error fetching product types', 'details' => $e->getMessage()]);
        }
    }
}