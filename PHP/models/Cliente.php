<?php
class Cliente {
    private $conn;
    private $table_name = "clientes";

    public $id_cliente;
    public $nome;
    public $telefone;
    public $email;
    public $endereco;
    public $cpf_cnpj;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, telefone=:telefone, email=:email, endereco=:endereco, cpf_cnpj=:cpf_cnpj";
        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->endereco = htmlspecialchars(strip_tags($this->endereco));
        $this->cpf_cnpj = htmlspecialchars(strip_tags($this->cpf_cnpj));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":cpf_cnpj", $this->cpf_cnpj);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nome ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nome = :nome, telefone = :telefone, email = :email, endereco = :endereco, cpf_cnpj = :cpf_cnpj WHERE id_cliente = :id_cliente";
        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->endereco = htmlspecialchars(strip_tags($this->endereco));
        $this->cpf_cnpj = htmlspecialchars(strip_tags($this->cpf_cnpj));
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":cpf_cnpj", $this->cpf_cnpj);
        $stmt->bindParam(":id_cliente", $this->id_cliente);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_cliente = :id_cliente";
        $stmt = $this->conn->prepare($query);

        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
        $stmt->bindParam(":id_cliente", $this->id_cliente);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
