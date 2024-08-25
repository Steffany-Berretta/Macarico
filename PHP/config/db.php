<?php
// db.php

class Database {
    private $host = "localhost";
    private $db_name = "macarico_db";  // Nome do banco de dados
    private $username = "root";        // Nome de usuário do MySQL
    private $password = "";            // Senha do MySQL (normalmente vazio no XAMPP por padrão)
    public $conn;

    // Método para obter a conexão com o banco de dados
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
