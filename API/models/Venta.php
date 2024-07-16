<?php
class Venta {
    private $conn;
    private $table = 'Ventas';

    public $id;
    public $prenda_id;
    public $fecha;
    public $cantidad;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($input) {
        $query = 'INSERT INTO ' . $this->table . ' SET prenda_id = :prenda_id, fecha = :fecha, cantidad = :cantidad';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':prenda_id', $input['prenda_id']);
        $stmt->bindParam(':fecha', $input['fecha']);
        $stmt->bindParam(':cantidad', $input['cantidad']);
        $stmt->execute();
    }

    public function update($id, $input) {
        $query = 'UPDATE ' . $this->table . ' SET prenda_id = :prenda_id, fecha = :fecha, cantidad = :cantidad WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':prenda_id', $input['prenda_id']);
        $stmt->bindParam(':fecha', $input['fecha']);
        $stmt->bindParam(':cantidad', $input['cantidad']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}