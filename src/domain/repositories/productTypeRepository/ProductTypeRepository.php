<?php
namespace YourNamespace\domain\repositories\productTypeRepository;

use YourNamespace\domain\entities\productType\ProductType;

class ProductTypeRepository {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function save(ProductType $productType) {
        $this->entityManager->persist($productType);
        $this->entityManager->flush();
    }

    public function find($id) {
        return $this->entityManager->find(ProductType::class, $id);
    }

}
