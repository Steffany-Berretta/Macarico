<?php
include_once '../config/db.php';
include_once '../models/MovimentacaoEstoque.php';

class MovimentacaoEstoqueController {
    private $db;
    private $movimentacaoEstoque;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->movimentacaoEstoque = new MovimentacaoEstoque($this->db);
    }

    public function create() {
        if (isset($_POST['id_produto']) && isset($_POST['quantidade']) && isset($_POST['tipo_movimentacao']) && isset($_POST['data_movimentacao'])) {
            $this->movimentacaoEstoque->id_produto = $_POST['id_produto'];
            $this->movimentacaoEstoque->quantidade = $_POST['quantidade'];
            $this->movimentacaoEstoque->tipo_movimentacao = $_POST['tipo_movimentacao'];
            $this->movimentacaoEstoque->data_movimentacao = $_POST['data_movimentacao'];
            $this->movimentacaoEstoque->observacao = $_POST['observacao'] ?? '';

            if ($this->movimentacaoEstoque->create()) {
                echo json_encode(["message" => "Movimentação de estoque criada com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao criar a movimentação de estoque."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function read() {
        $stmt = $this->movimentacaoEstoque->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $movimentacoes_arr = array();
            $movimentacoes_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $movimentacao_item = array(
                    "id_movimentacao" => $id_movimentacao,
                    "id_produto" => $id_produto,
                    "quantidade" => $quantidade,
                    "tipo_movimentacao" => $tipo_movimentacao,
                    "data_movimentacao" => $data_movimentacao,
                    "observacao" => $observacao
                );
                array_push($movimentacoes_arr["records"], $movimentacao_item);
            }

            echo json_encode($movimentacoes_arr);
        } else {
            echo json_encode(array("message" => "Nenhuma movimentação de estoque encontrada."));
        }
    }

    public function update() {
        if (isset($_POST['id_movimentacao']) && isset($_POST['id_produto']) && isset($_POST['quantidade']) && isset($_POST['tipo_movimentacao']) && isset($_POST['data_movimentacao'])) {
            $this->movimentacaoEstoque->id_movimentacao = $_POST['id_movimentacao'];
            $this->movimentacaoEstoque->id_produto = $_POST['id_produto'];
            $this->movimentacaoEstoque->quantidade = $_POST['quantidade'];
            $this->movimentacaoEstoque->tipo_movimentacao = $_POST['tipo_movimentacao'];
            $this->movimentacaoEstoque->data_movimentacao = $_POST['data_movimentacao'];
            $this->movimentacaoEstoque->observacao = $_POST['observacao'] ?? '';

            if ($this->movimentacaoEstoque->update()) {
                echo json_encode(["message" => "Movimentação de estoque atualizada com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao atualizar a movimentação de estoque."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete() {
        if (isset($_POST['id_movimentacao'])) {
            $this->movimentacaoEstoque->id_movimentacao = $_POST['id_movimentacao'];

            if ($this->movimentacaoEstoque->delete()) {
                echo json_encode(["message" => "Movimentação de estoque excluída com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao excluir a movimentação de estoque."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
?>
