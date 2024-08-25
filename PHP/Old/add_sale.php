<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber os dados enviados via POST
    $data = json_decode(file_get_contents('php://input'), true);

    $cliente = $data['cliente'];
    $produto = $data['produto'];
    $quantidade = $data['quantidade'];
    $preco = $data['preco'];

    // Usar os nomes das colunas conforme a tabela
    $stmt = $conn->prepare("INSERT INTO vendas (cliente, produto, quantidade, preco) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $cliente, $produto, $quantidade, $preco);

    if ($stmt->execute()) {
        $response = ['success' => true];
    } else {
        error_log("Erro ao executar SQL: " . $stmt->error, 3, "php_errors.log");
        $response = ['success' => false, 'error' => $stmt->error];
    }

    // Limpa qualquer conteúdo capturado antes de enviar a resposta JSON
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode($response);

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405); // Método não permitido
    $response = ['success' => false, 'message' => 'Method Not Allowed'];
    echo json_encode($response);
}
?>
