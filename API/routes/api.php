<?php
require_once __DIR__ . '/../controllers/MarcaController.php';
require_once __DIR__ . '/../controllers/PrendasController.php';
require_once __DIR__ . '/../controllers/VentasController.php';

// Initialize controllers
$marcaController = new MarcaController();
$prendasController = new PrendasController();
$ventasController = new VentasController();

// Routing based on HTTP method and URI
$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', $_SERVER['REQUEST_URI']);

switch ($uri[1]) {
    case 'marcas':
        if ($method == 'GET' && isset($uri[2])) {
            echo $marcaController->getMarcaById($uri[2]);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Marca endpoint not found']);
        }
        break;

    case 'prendas':
        if ($method == 'GET' && isset($uri[2])) {
            echo $prendasController->getPrendaById($uri[2]);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Prenda endpoint not found']);
        }
        break;

    case 'ventas':
        if ($method == 'GET' && isset($uri[2])) {
            echo $ventasController->getVentaById($uri[2]);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Venta endpoint not found']);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['message' => 'Endpoint not found']);
}
?>