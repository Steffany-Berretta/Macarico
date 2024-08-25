// script.js

document.addEventListener("DOMContentLoaded", function () {
  // Adicione interações específicas do painel de controle aqui

  // Exemplo: Atualizar dados do painel periodicamente
  function updateDashboard() {
    fetch("../PHP/get_dashboard_data.php")
      .then((response) => response.json())
      .then((data) => {
        // Atualize o painel com os dados recebidos
        document.getElementById("stock-total").textContent = data.stockTotal;
        document.getElementById("purchased-total").textContent =
          data.purchasedTotal;
        document.getElementById("sold-total").textContent = data.soldTotal;
      })
      .catch((error) => console.error("Erro ao atualizar o painel:", error));
  }

  // Atualize o painel a cada 5 minutos
  setInterval(updateDashboard, 300000);
});
