<?php
require_once __DIR__ . '/../database/db.php';

class Prenda {
    private $conn;
    private $id_prenda;
    private $nombre;
    private $tipo;
    private $precio;

    public function __construct($id_prenda = null, $nombre = null, $tipo = null, $precio = null) {
        $this->id_prenda = $id_prenda;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->precio = $precio;

        if (is_null($id_prenda)) {
            $database = new Database();
            $this->conn = $database->getConnection();
        }
    }

    public function getById($id) {
        $database = new Database();
        $this->conn = $database->getConnection();
        $query = 'SELECT id_prenda, nombre, tipo, precio FROM prenda WHERE id_prenda = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Prenda($row['id_prenda'], $row['nombre'], $row['tipo'], $row['precio']);
    }

    // Getters for prenda properties
    public function getId() {
        return $this->id_prenda;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getPrecio() {
        return $this->precio;
    }
}
?>
