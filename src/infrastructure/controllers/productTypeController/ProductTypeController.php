<?php
namespace workanaSoftexpert\infrastructure\controllers\productTypeController;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
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

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function createProductType($request)
    {
        $productTypeCreateRequest = new ProductTypeCreateRequest($request);
        $productType = $this->productTypeService->createProductType($productTypeCreateRequest);
        return json_encode(new ProductTypeResponse($productType));
    }

    /**
     * @throws \Exception
     */
    public function updateProductType($request, $productTypeId) {
        $productType = $this->productTypeService->updateProductType($productTypeId, $request);
        return json_encode(new ProductTypeResponse($productType));
    }

    /**
     * @throws \Exception
     */
    public function deleteProductType($productTypeId) {
        $this->productTypeService->deleteProductType($productTypeId);
        return json_encode(['message' => 'Product type successfully deleted']);
    }

    public function getAllProductTypes() {
        $productTypes = $this->productTypeService->getAllProductsTypes();
        return json_encode(array_map(function($productType) {
            return new ProductTypeResponse($productType);
        }, $productTypes));
    }
}
