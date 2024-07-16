<?php
class Marca {
    private $conn;
    private $table = 'Marcas';

    public $id;
    public $nombre;

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
        $query = 'INSERT INTO ' . $this->table . ' SET nombre = :nombre';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $input['nombre']);
        $stmt->execute();
    }

    public function update($id, $input) {
        $query = 'UPDATE ' . $this->table . ' SET nombre = :nombre WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $input['nombre']);
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