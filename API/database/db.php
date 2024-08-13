<?php
class Database {
    private $host = 'localhost'; // Your database host
    private $db_name = 'tiendaropa'; // Your database name
    private $username = 'root'; // Your database username
    private $password = ''; // Your database password
    private $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8',
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Log error or handle it in a way that does not expose sensitive information
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
