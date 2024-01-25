<?php
namespace workanaSoftexpert\infrastructure\controllers\sellController;

use workanaSoftexpert\applications\services\sellService\SellService;
use workanaSoftexpert\core\dto\sellCreateRequest\SellCreateRequest;
use workanaSoftexpert\core\dto\sellResponse\SellResponse;

class SellController {
    private $sellService;

    public function __construct(SellService $sellService) {
        $this->sellService = $sellService;
    }

    public function createSell($request) {
        try {
            $sellCreateRequest = new SellCreateRequest($request);
            $sell = $this->sellService->createSell($sellCreateRequest);
            return json_encode(new SellResponse($sell));
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode(['error' => 'Error creating sell', 'details' => $e->getMessage()]);
        }
    }

    public function getAllSells() {
        try {
            $sells = $this->sellService->findAll();
            $responses = array_map(function($sell) {
                return new SellResponse($sell);
            }, $sells);

            return json_encode($responses);
        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode(['error' => 'Error fetching sells', 'details' => $e->getMessage()]);
        }
    }

    public function deleteSell($sellId) {
        try {
            $this->sellService->deleteSell($sellId);
            return json_encode(['message' => 'Sell successfully deleted']);
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode(['error' => 'Error deleting sell', 'details' => $e->getMessage()]);
        }
    }

    public function updateSell($requestData, $sellId) {
        try {
            $sellRequest = new SellCreateRequest($requestData);
            $sell = $this->sellService->updateSell($sellId, $sellRequest);
            return json_encode(new SellResponse($sell));
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode(['error' => 'Error updating sell', 'details' => $e->getMessage()]);
        }
    }
}
