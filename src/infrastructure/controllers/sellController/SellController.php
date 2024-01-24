<?php
namespace workanaSoftexpert\infrastructure\controllers\sellController;

use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use workanaSoftexpert\applications\services\sellService\SellService;
use workanaSoftexpert\core\dto\sellCreateRequest\SellCreateRequest;
use workanaSoftexpert\core\dto\sellResponse\SellResponse;

class SellController {
    private $sellService;

    public function __construct(SellService $sellService) {
        $this->sellService = $sellService;
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function createSell($request) {
        $sellCreateRequest = new SellCreateRequest($request);
        $sell = $this->sellService->createSell($sellCreateRequest);
        return json_encode(new SellResponse($sell));
    }

    public function getAllSells() {
        $sells = $this->sellService->findAll();
        $responses = array_map(function($sell) {
            return new SellResponse($sell);
        }, $sells);

        return json_encode($responses);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function deleteSell($sellId) {
        $this->sellService->deleteSell($sellId);
        return json_encode(['message' => 'Sell successfully deleted']);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws TransactionRequiredException
     * @throws EntityNotFoundException
     */
    public function updateSell($requestData, $sellId) {
        $sellRequest = new SellCreateRequest($requestData);
        $sell = $this->sellService->updateSell($sellId, $sellRequest);
        return json_encode(new SellResponse($sell));
    }

}
