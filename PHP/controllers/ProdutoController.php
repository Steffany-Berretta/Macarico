<?php
include_once '../config/db.php';
include_once '../models/Produtos.php';

class ProdutoController {
    private $db;
    private $produto;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->produto = new Produto($this->db);
    }

    // Método para criar um novo produto
    public function create() {
        if (isset($_POST['nome']) && isset($_POST['preco_venda'])) {
            $this->produto->nome = $_POST['nome'];
            $this->produto->descricao = $_POST['descricao'] ?? '';
            $this->produto->codigo_de_barras = $_POST['codigo_de_barras'] ?? '';
            $this->produto->preco_custo = $_POST['preco_custo'] ?? 0;
            $this->produto->preco_venda = $_POST['preco_venda'];
            $this->produto->quantidade_estoque = $_POST['quantidade_estoque'] ?? 0;

            if ($this->produto->create()) {
                echo json_encode(["message" => "Produto criado com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao criar o produto."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    // Método para ler todos os produtos
    public function read() {
        $stmt = $this->produto->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $produtos_arr = array();
            $produtos_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $produto_item = array(
                    "id_produto" => $id_produto,
                    "nome" => $nome,
                    "descricao" => $descricao,
                    "codigo_de_barras" => $codigo_de_barras,
                    "preco_custo" => $preco_custo,
                    "preco_venda" => $preco_venda,
                    "quantidade_estoque" => $quantidade_estoque,
                    "data_criacao" => $data_criacao,
                    "data_atualizacao" => $data_atualizacao
                );
                array_push($produtos_arr["records"], $produto_item);
            }

            echo json_encode($produtos_arr);
        } else {
            echo json_encode(array("message" => "Nenhum produto encontrado."));
        }
    }

    // Método para atualizar um produto existente
    public function update() {
        if (isset($_POST['id_produto']) && isset($_POST['nome']) && isset($_POST['preco_venda'])) {
            $this->produto->id_produto = $_POST['id_produto'];
            $this->produto->nome = $_POST['nome'];
            $this->produto->descricao = $_POST['descricao'] ?? '';
            $this->produto->codigo_de_barras = $_POST['codigo_de_barras'] ?? '';
            $this->produto->preco_custo = $_POST['preco_custo'] ?? 0;
            $this->produto->preco_venda = $_POST['preco_venda'];
            $this->produto->quantidade_estoque = $_POST['quantidade_estoque'] ?? 0;

            if ($this->produto->update()) {
                echo json_encode(["message" => "Produto atualizado com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao atualizar o produto."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    // Método para excluir um produto
    public function delete() {
        if (isset($_POST['id_produto'])) {
            $this->produto->id_produto = $_POST['id_produto'];

            if ($this->produto->delete()) {
                echo json_encode(["message" => "Produto excluído com sucesso."]);
            } else {
                echo json_encode(["message" => "Falha ao excluir o produto."]);
            }
        } else {
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
?>
