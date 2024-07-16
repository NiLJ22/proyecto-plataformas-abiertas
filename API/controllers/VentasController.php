<?php
require 'models/Venta.php';

class VentasController {
    private $venta;

    public function __construct() {
        $this->venta = new Venta();
    }

    public function handleRequest($method, $uri, $input) {
        switch ($method) {
            case 'GET':
                if (isset($uri[3])) {
                    $this->getVenta($uri[3]);
                } else {
                    $this->getVentas();
                }
                break;
            case 'POST':
                $this->createVenta($input);
                break;
            case 'PUT':
                $this->updateVenta($uri[3], $input);
                break;
            case 'DELETE':
                $this->deleteVenta($uri[3]);
                break;
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method not allowed']);
                break;
        }
    }

    private function getVentas() {
        $result = $this->venta->read();
        echo json_encode($result);
    }

    private function getVenta($id) {
        $result = $this->venta->readOne($id);
        echo json_encode($result);
    }

    private function createVenta($input) {
        $this->venta->create($input);
        echo json_encode(['message' => 'Venta creada']);
    }

    private function updateVenta($id, $input) {
        $this->venta->update($id, $input);
        echo json_encode(['message' => 'Venta actualizada']);
    }

    private function deleteVenta($id) {
        $this->venta->delete($id);
        echo json_encode(['message' => 'Venta eliminada']);
    }
}