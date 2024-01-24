<?php
namespace workanaSoftexpert\domain\repositories\sellRepository;

use workanaSoftexpert\domain\entities\sell\Sell;

class SellRepository {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function save(Sell $sell) {
        $this->entityManager->persist($sell);
        $this->entityManager->flush();
    }

    public function find($id) {
        return $this->entityManager->find(Sell::class, $id);
    }

    public function findAll() {
        return $this->entityManager->getRepository(Sell::class)->findAll();
    }

}