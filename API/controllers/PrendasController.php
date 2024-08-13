<?php
require_once __DIR__ . '/../models/Prenda.php';

class PrendasController {
    private $prendaModel;

    public function __construct() {
        $this->prendaModel = new Prenda();
    }

    // Método para obtener los detalles de una prenda por ID
    public function getPrendaById($id) {
        $prenda = $this->prendaModel->getById($id);
        if ($prenda) {
            // Devolver detalles de la prenda en formato JSON
            $response = array(
                'id' => $prenda->getId(),
                'nombre' => $prenda->getNombre(),
                'tipo' => $prenda->getTipo(),
                'precio' => $prenda->getPrecio()
            );
            header("Content-Type: application/json; charset=UTF-8");
            return json_encode($response);
        } else {
            // Prenda no encontrada
            http_response_code(404); // No encontrado
            header("Content-Type: application/json; charset=UTF-8");
            return json_encode(array('message' => 'Prenda not found'));
        }
    }
}