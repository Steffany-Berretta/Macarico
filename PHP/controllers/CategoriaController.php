<?php
include_once '../config/db.php';
include_once '../models/Categoria.php';

class CategoriaController {
    private $db;
    private $categoria;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->categoria = new Categoria($this->db);
    }

    public function create() {
        if (isset($_POST['nome'])) {
            $this->categoria->nome = $_POST['nome'];
            $this->categoria->descricao = $_POST['descricao'] ?? '';

            if ($this->categoria->create()) {
                echo json_encode(["message" => "Categoria criada com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao criar a categoria."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function read() {
        $stmt = $this->categoria->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $categorias_arr = array();
            $categorias_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $categoria_item = array(
                    "id_categoria" => $id_categoria,
                    "nome" => $nome,
                    "descricao" => $descricao
                );
                array_push($categorias_arr["records"], $categoria_item);
            }

            echo json_encode($categorias_arr);
        } else {
            echo json_encode(array("message" => "Nenhuma categoria encontrada."));
        }
    }

    public function update() {
        if (isset($_POST['id_categoria']) && isset($_POST['nome'])) {
            $this->categoria->id_categoria = $_POST['id_categoria'];
            $this->categoria->nome = $_POST['nome'];
            $this->categoria->descricao = $_POST['descricao'] ?? '';

            if ($this->categoria->update()) {
                echo json_encode(["message" => "Categoria atualizada com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao atualizar a categoria."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete() {
        if (isset($_POST['id_categoria'])) {
            $this->categoria->id_categoria = $_POST['id_categoria'];

            if ($this->categoria->delete()) {
                echo json_encode(["message" => "Categoria excluída com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao excluir a categoria."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
?>
