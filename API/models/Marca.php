<?php
require_once __DIR__ . '/../database/db.php';

class Marca {
    private $conn;
    private $id_marca;
    private $nombre;
    private $descripcion;
    private $estilo;

    public function __construct($id_marca = null, $nombre = null, $descripcion = null, $estilo = null) {
        $this->id_marca = $id_marca;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->estilo = $estilo;

        if (is_null($id_marca)) {
            $database = new Database();
            $this->conn = $database->getConnection();
        }
    }

    public function getById($id) {

        $database = new Database();
        $this->conn = $database->getConnection();
        $query = 'SELECT id_marca, nombre, descripcion, estilo FROM marca WHERE id_marca = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Marca($row['id_marca'], $row['nombre'], $row['descripcion'], $row['estilo']);
    }

    // Getters for marca properties
    public function getId() {
        return $this->id_marca;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getEstilo() {
        return $this->estilo;
    }
}
?>
