<?php
require_once __DIR__ . '/../models/Marca.php';

class MarcaController {
    private $marcaModel;

    public function __construct() {
        $this->marcaModel = new Marca();
    }

    // Example method to get Marca details by ID
    public function getMarcaById($id) {
        $marca = $this->marcaModel->getById($id);
        if ($marca) {
            // Return marca details in JSON format
            $response = array(
                'id' => $marca->getId(),
                'nombre' => $marca->getNombre(),
                'descripcion' => $marca->getDescripcion(),
                'estilo' => $marca->getEstilo()
            );
            header("Content-Type: application/json; charset=UTF-8");
            return json_encode($response);
        } else {
            // Marca not found
            http_response_code(404); // Not Found
            header("Content-Type: application/json; charset=UTF-8");
            return json_encode(array('message' => 'Marca not found'));
        }
    }
}