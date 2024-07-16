<?php
require 'database/db.php';
require 'routes/api.php';

// Configuración de encabezados para permitir solicitudes desde cualquier origen
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$controller = $uri[2] . 'Controller';
$method = $_SERVER['REQUEST_METHOD'];

$input = json_decode(file_get_contents('php://input'), true);

// Llama a la función adecuada del controlador
if (file_exists("controllers/{$controller}.php")) {
    require "controllers/{$controller}.php";
    $controllerInstance = new $controller();
    $controllerInstance->handleRequest($method, $uri, $input);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Endpoint not found']);
}