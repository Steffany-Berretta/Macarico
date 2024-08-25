<?php
// Incluir o arquivo de conexão
include 'db_connection.php';

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}

// Fechar a conexão
closeConnection($conn);
?>
