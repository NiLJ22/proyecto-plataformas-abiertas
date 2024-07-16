<?php
require 'models/Marca.php';

class MarcasController {
    private $marca;

    public function __construct() {
        $this->marca = new Marca();
    }

    public function handleRequest($method, $uri, $input) {
        switch ($method) {
            case 'GET':
                if (isset($uri[3])) {
                    $this->getMarca($uri[3]);
                } else {
                    $this->getMarcas();
                }
                break;
            case 'POST':
                $this->createMarca($input);
                break;
            case 'PUT':
                $this->updateMarca($uri[3], $input);
                break;
            case 'DELETE':
                $this->deleteMarca($uri[3]);
                break;
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method not allowed']);
                break;
        }
    }

    private function getMarcas() {
        $result = $this->marca->read();
        echo json_encode($result);
    }

    private function getMarca($id) {
        $result = $this->marca->readOne($id);
        echo json_encode($result);
    }

    private function createMarca($input) {
        $this->marca->create($input);
        echo json_encode(['message' => 'Marca creada']);
    }

    private function updateMarca($id, $input) {
        $this->marca->update($id, $input);
        echo json_encode(['message' => 'Marca actualizada']);
    }

    private function deleteMarca($id) {
        $this->marca->delete($id);
        echo json_encode(['message' => 'Marca eliminada']);
    }
}