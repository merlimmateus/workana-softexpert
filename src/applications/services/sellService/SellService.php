<?php

namespace workanaSoftexpert\applications\services\sellService;

use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use workanaSoftexpert\core\dto\sellCreateRequest\SellCreateRequest;
use workanaSoftexpert\domain\entities\sell\Sell;
use workanaSoftexpert\domain\repositories\sellRepository\SellRepository;
use workanaSoftexpert\domain\repositories\productRepository\ProductRepository;
use workanaSoftexpert\domain\repositories\userRepository\UserRepository;

class SellService {
    private $sellRepository;
    private $productRepository;
    private $userRepository;

    public function __construct(SellRepository $sellRepository, ProductRepository $productRepository, UserRepository $userRepository) {
        $this->sellRepository = $sellRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function createSell(SellCreateRequest $request): Sell {
        $product = $this->productRepository->find($request->productId);

        if ($product->isExcluded()) {
            throw new \RuntimeException("Cannot create sell with an excluded product.");
        }

        $user = $this->userRepository->find($request->createdByUserId);

        $sell = new Sell();
        $sell->setProduct($product);
        $sell->setQuantity($request->quantity);
        $sell->setName($request->name);
        $sell->setCreatedByUser($user);

        $this->sellRepository->save($sell);

        return $sell;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws TransactionRequiredException
     * @throws EntityNotFoundException
     */
    public function updateSell($sellId, SellCreateRequest $request):Sell {
        $sell = $this->sellRepository->find($sellId);
        if (!$sell) {
            throw new EntityNotFoundException("Sell not found.");
        }

        $product = $this->productRepository->find($request->productId);

        if ($product->isExcluded()) {
            throw new \RuntimeException("Cannot create sell with an excluded product.");
        }

        $user = $this->userRepository->find($request->createdByUserId);

        $sell->setProduct($product);
        $sell->setQuantity($request->quantity);
        $sell->setCreatedByUser($user);
        $sell->setName($request->name);

        $this->sellRepository->save($sell);

        return $sell;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function deleteSell($sellId) {
        $sell = $this->sellRepository->find($sellId);
        if (!$sell) {
            throw new EntityNotFoundException("Sell not found.");
        }

        $sell->setExcluded(true);
        $this->sellRepository->save($sell);
    }

    public function findAll() {
        return $this->sellRepository->findAll();
    }
}
