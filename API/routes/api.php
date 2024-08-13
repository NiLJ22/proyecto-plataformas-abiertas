<?php
require_once "controllers/MarcasController.php";

$marcaController = new MarcaController();

// Handle GET request for fetching user details by ID
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $response = $marcaController->getMarcaById($id);
        echo $response;
    } else {
        http_response_code(400); // Bad request
        echo json_encode(array('message' => 'ID parameter is required'));
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => 'Method not allowed'));
}
?>
