document.addEventListener("DOMContentLoaded", function() {
    // Código específico para a página de Compras
    // Exemplo: Gerenciar pedidos de compra, visualizar status, etc.

    document.getElementById('new-purchase-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../PHP/add_purchase.php', {  // Certifique-se de que este caminho está correto
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);  // Pode substituir por código para exibir mensagem de sucesso ou erro
        })
        .catch(error => console.error('Erro:', error));
    });

    // Outras funcionalidades específicas da página de Compras
});
