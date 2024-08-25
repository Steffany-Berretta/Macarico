<?php
class EncomendaController {
    private $db;
    private $encomenda;
    private $itensEncomenda;

    public function __construct($db) {
        $this->db = $db;
        $this->encomenda = new Encomenda($db);
        $this->itensEncomenda = new ItensEncomenda($db);
    }

    // Método para criar uma nova encomenda
    public function create() {
        $this->encomenda->id_cliente = $_POST['id_cliente'];
        $this->encomenda->data_encomenda = $_POST['data_encomenda'];
        $this->encomenda->status = $_POST['status'];
        $this->encomenda->valor_total = $_POST['valor_total'];

        // Tenta criar a encomenda
        if($this->encomenda->create()) {
            $encomenda_id = $this->db->lastInsertId(); // Obtenha o ID da encomenda recém-criada
            $itens = $_POST['itens']; // Espera-se que 'itens' seja um array de itens a serem encomendados

            foreach($itens as $item) {
                $this->itensEncomenda->id_encomenda = $encomenda_id;
                $this->itensEncomenda->id_produto = $item['id_produto'];
                $this->itensEncomenda->id_fornecedor = $item['id_fornecedor'];
                $this->itensEncomenda->quantidade = $item['quantidade'];
                $this->itensEncomenda->preco_unitario = $item['preco_unitario'];

                if(!$this->itensEncomenda->create()) {
                    echo json_encode(["message" => "Falha ao adicionar o item à encomenda."]);
                    return;
                }
            }

            echo json_encode(["message" => "Encomenda e itens criados com sucesso."]);
        } else {
            echo json_encode(["message" => "Falha ao criar a encomenda."]);
        }
    }

    // Método para ler encomendas
    public function read() {
        $stmt = $this->encomenda->read();
        $num = $stmt->rowCount();

        if($num > 0) {
            $encomendas_arr = array();
            $encomendas_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $encomenda_item = array(
                    "id_encomenda" => $id_encomenda,
                    "id_cliente" => $id_cliente,
                    "data_encomenda" => $data_encomenda,
                    "status" => $status,
                    "valor_total" => $valor_total
                );

                array_push($encomendas_arr["records"], $encomenda_item);
            }

            echo json_encode($encomendas_arr);
        } else {
            echo json_encode(["message" => "Nenhuma encomenda encontrada."]);
        }
    }

    // Método para atualizar uma encomenda
    public function update() {
        $this->encomenda->id_encomenda = $_POST['id_encomenda'];
        $this->encomenda->id_cliente = $_POST['id_cliente'];
        $this->encomenda->data_encomenda = $_POST['data_encomenda'];
        $this->encomenda->status = $_POST['status'];
        $this->encomenda->valor_total = $_POST['valor_total'];

        if($this->encomenda->update()) {
            echo json_encode(["message" => "Encomenda atualizada com sucesso."]);
        } else {
            echo json_encode(["message" => "Falha ao atualizar a encomenda."]);
        }
    }

    // Método para deletar uma encomenda
    public function delete() {
        $this->encomenda->id_encomenda = $_POST['id_encomenda'];

        if($this->encomenda->delete()) {
            echo json_encode(["message" => "Encomenda deletada com sucesso."]);
        } else {
            echo json_encode(["message" => "Falha ao deletar a encomenda."]);
        }
    }
}
?>
