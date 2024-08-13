<?php
require_once __DIR__ . '/../models/Venta.php';

class VentasController {
    private $ventaModel;

    public function __construct() {
        $this->ventaModel = new Venta();
    }

    // Método para obtener los detalles de una venta por ID
    public function getVentaById($id) {
        $venta = $this->ventaModel->getById($id);
        if ($venta) {
            // Devolver detalles de la venta en formato JSON
            $response = array(
                'id' => $venta->getId(),
                'cliente' => $venta->getCliente(),
                'fecha' => $venta->getFecha(),
                'total' => $venta->getTotal()
            );
            header("Content-Type: application/json; charset=UTF-8");
            return json_encode($response);
        } else {
            // Venta no encontrada
            http_response_code(404); // No encontrado
            header("Content-Type: application/json; charset=UTF-8");
            return json_encode(array('message' => 'Venta not found'));
        }
    }
}