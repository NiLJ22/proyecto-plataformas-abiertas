<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Routing
$requestUri = $_SERVER['REQUEST_URI'];
$basePath = '/proyecto-api/API/index.php'; // Adjust this if your API is located in a subdirectory

// Remove base path from request URI
if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

// Remove query string from request URI
$requestUri = strtok($requestUri, '?');

// Route requests
switch ($requestUri) {
    case '/marcas':
        require_once   './routes/api.php';
        break;
    default:
        http_response_code(404); // Not Found
        echo json_encode(['message' => 'Endpoint not found']);
}
?>
