<?php
require_once __DIR__ . '/../database/db.php';

class Venta {
    private $conn;
    private $id_venta;
    private $cliente;
    private $fecha;
    private $total;

    public function __construct($id_venta = null, $cliente = null, $fecha = null, $total = null) {
        $this->id_venta = $id_venta;
        $this->cliente = $cliente;
        $this->fecha = $fecha;
        $this->total = $total;

        if (is_null($id_venta)) {
            $database = new Database();
            $this->conn = $database->getConnection();
        }
    }

    public function getById($id) {
        $database = new Database();
        $this->conn = $database->getConnection();
        $query = 'SELECT id_venta, cliente, fecha, total FROM venta WHERE id_venta = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Venta($row['id_venta'], $row['cliente'], $row['fecha'], $row['total']);
    }

    // Getters for venta properties
    public function getId() {
        return $this->id_venta;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getTotal() {
        return $this->total;
    }
}
?>
