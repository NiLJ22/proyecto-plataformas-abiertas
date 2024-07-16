<?php
require 'models/Prenda.php';

class PrendasController {
    private $prenda;

    public function __construct() {
        $this->prenda = new Prenda();
    }

    public function handleRequest($method, $uri, $input) {
        switch ($method) {
            case 'GET':
                if (isset($uri[3])) {
                    $this->getPrenda($uri[3]);
                } else {
                    $this->getPrendas();
                }
                break;
            case 'POST':
                $this->createPrenda($input);
                break;
            case 'PUT':
                $this->updatePrenda($uri[3], $input);
                break;
            case 'DELETE':
                $this->deletePrenda($uri[3]);
                break;
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method not allowed']);
                break;
        }
    }

    private function getPrendas() {
        $result = $this->prenda->read();
        echo json_encode($result);
    }

    private function getPrenda($id) {
        $result = $this->prenda->readOne($id);
        echo json_encode($result);
    }

    private function createPrenda($input) {
        $this->prenda->create($input);
        echo json_encode(['message' => 'Prenda creada']);
    }

    private function updatePrenda($id, $input) {
        $this->prenda->update($id, $input);
        echo json_encode(['message' => 'Prenda actualizada']);
    }

    private function deletePrenda($id) {
        $this->prenda->delete($id);
        echo json_encode(['message' => 'Prenda eliminada']);
    }
}