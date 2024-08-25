document.addEventListener("DOMContentLoaded", function() {
    // Código específico para a página de Inventário
    // Exemplo: Adicionar novas compras, editar itens de estoque, etc.

    document.getElementById('add-item-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../PHP/add_inventory_item.php', {  // Aqui você deve apontar para o arquivo PHP correto
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);  // Pode substituir por código para exibir mensagem de sucesso ou erro
        })
        .catch(error => console.error('Erro:', error));
    });

    // Outras funcionalidades específicas da página de Inventário
});
