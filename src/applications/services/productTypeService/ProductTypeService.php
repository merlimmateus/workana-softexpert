<?php
namespace workanaSoftexpert\applications\services\productTypeService;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use workanaSoftexpert\core\dto\productTypeCreateRequest\ProductTypeCreateRequest;
use workanaSoftexpert\domain\entities\productType\ProductType;
use workanaSoftexpert\domain\repositories\productTypeRepository\ProductTypeRepository;
use workanaSoftexpert\domain\repositories\userRepository\UserRepository;

class ProductTypeService {
    private $productTypeRepository;
    private $userRepository;

    public function __construct(ProductTypeRepository $productTypeRepository, UserRepository $userRepository) {
        $this->productTypeRepository = $productTypeRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     * @throws \Exception
     */
    public function createProductType(ProductTypeCreateRequest $request): ProductType
    {
        $productType = new ProductType();
        $productType->setName($request->getName());
        $productType->setTaxPercentage($request->getTaxPercentage());

        $user = $this->userRepository->find($request->getCreatedByUserId());
        if (!$user) {
            throw new \RuntimeException("User not found.");
        }

        $productType->setCreatedByUser($user);
        $this->productTypeRepository->save($productType);

        return $productType;
    }

    /**
     * @throws \Exception
     */
    public function updateProductType($productTypeId, $data) {
        $productType = $this->productTypeRepository->find($productTypeId);
        if (!$productType) {
            throw new \RuntimeException("Product type not found.");
        }
        if (isset($data['name'])) {
            $productType->setName($data['name']);
        }
        if (isset($data['taxPercentage'])) {
            $productType->setTaxPercentage($data['taxPercentage']);
        }
        $this->productTypeRepository->save($productType);
        return $productType;
    }

    /**
     * @throws \Exception
     */
    public function deleteProductType($productTypeId) {
        $productType = $this->productTypeRepository->find($productTypeId);
        if (!$productType) {
            throw new \Exception("Product type not found.");
        }
        $productType->setExcluded(true);
        $this->productTypeRepository->save($productType);
    }

    public function getAllProductTypes() {
        return $this->productTypeRepository->findAll();
    }

}
