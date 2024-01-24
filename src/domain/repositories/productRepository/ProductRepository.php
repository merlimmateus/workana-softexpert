<?php
namespace workanaSoftexpert\domain\repositories\productRepository;

use workanaSoftexpert\domain\entities\product\Product;

class ProductRepository {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function save(Product $product) {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function find($id) {
        return $this->entityManager->find(Product::class, $id);
    }

    public function findAll() {
        return $this->entityManager->getRepository(Product::class)->findAll();
    }
}
