<?php
class Fornecedor {
    private $conn;
    private $table_name = "fornecedores";

    public $id_fornecedor;
    public $nome;
    public $contato;
    public $telefone;
    public $email;
    public $endereco;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, contato=:contato, telefone=:telefone, email=:email, endereco=:endereco";
        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->contato = htmlspecialchars(strip_tags($this->contato));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->endereco = htmlspecialchars(strip_tags($this->endereco));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":contato", $this->contato);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":endereco", $this->endereco);

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
        $query = "UPDATE " . $this->table_name . " SET nome = :nome, contato = :contato, telefone = :telefone, email = :email, endereco = :endereco WHERE id_fornecedor = :id_fornecedor";
        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->contato = htmlspecialchars(strip_tags($this->contato));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->endereco = htmlspecialchars(strip_tags($this->endereco));
        $this->id_fornecedor = htmlspecialchars(strip_tags($this->id_fornecedor));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":contato", $this->contato);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":id_fornecedor", $this->id_fornecedor);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_fornecedor = :id_fornecedor";
        $stmt = $this->conn->prepare($query);

        $this->id_fornecedor = htmlspecialchars(strip_tags($this->id_fornecedor));
        $stmt->bindParam(":id_fornecedor", $this->id_fornecedor);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
