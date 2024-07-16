<?php
class Prenda {
    private $conn;
    private $table = 'Prendas';

    public $id;
    public $marca_id;
    public $nombre;
    public $stock;

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
        $query = 'INSERT INTO ' . $this->table . ' SET marca_id = :marca_id, nombre = :nombre, stock = :stock';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':marca_id', $input['marca_id']);
        $stmt->bindParam(':nombre', $input['nombre']);
        $stmt->bindParam(':stock', $input['stock']);
        $stmt->execute();
    }

    public function update($id, $input) {
        $query = 'UPDATE ' . $this->table . ' SET marca_id = :marca_id, nombre = :nombre, stock = :stock WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':marca_id', $input['marca_id']);
        $stmt->bindParam(':nombre', $input['nombre']);
        $stmt->bindParam(':stock', $input['stock']);
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