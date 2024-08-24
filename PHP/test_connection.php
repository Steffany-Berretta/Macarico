<?php
$servername = "localhost"; // O servidor onde o MySQL está rodando
$username = "root";         // Nome de usuário do MySQL (padrão é "root")
$password = ""; // Senha do MySQL para o usuário "root"
$dbname = "Macarico_DB";    // Nome do banco de dados que você quer acessar

// Criar a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}
?>
