document.addEventListener("DOMContentLoaded", function () {
    // Função para enviar os dados do formulário de vendas ao servidor
    document.getElementById("sales-form").addEventListener("submit", function (e) {
        e.preventDefault(); // Previne o comportamento padrão do formulário
        const cliente = document.getElementById("cliente").value;
        const produto = document.getElementById("produto").value;
        const quantidade = document.getElementById("quantidade").value;
        const preco = document.getElementById("preco").value;

        // Enviar os dados ao servidor usando fetch
        fetch('../PHP/add_sale.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ cliente, produto, quantidade, preco })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Venda registrada com sucesso!");
                updateSalesChart(); // Atualiza o gráfico após a venda ser registrada
            } else {
                alert("Erro ao registrar venda.");
            }
        })
        .catch(error => console.error('Erro:', error));
    });

    // Função para renderizar o gráfico de vendas
    function updateSalesChart() {
        fetch('../PHP/get_dashboard_data.php')
            .then(response => response.json())
            .then(data => {
                var ctx = document.getElementById('salesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Vendas', 'Estoque', 'Compras'],
                        datasets: [{
                            label: 'Dados',
                            data: [data.total_sales, data.total_inventory, data.total_purchases],
                            backgroundColor: ['red', 'green', 'blue']
                        }]
                    }
                });
            })
            .catch(error => console.error('Erro ao carregar os dados:', error));
    }

    // Chama a função para carregar o gráfico inicialmente
    updateSalesChart();
});
