document.addEventListener("DOMContentLoaded", function() {
    const filterForm = document.getElementById("filter-form");
    const reportType = document.getElementById("report-type");
    const reportPeriod = document.getElementById("report-period");
    const customPeriod = document.getElementById("custom-period");
    const reportOutput = document.getElementById("report-output");

    // Mostrar/ocultar campos de período personalizado
    reportPeriod.addEventListener("change", function() {
        if (reportPeriod.value === "custom") {
            customPeriod.style.display = "flex";
        } else {
            customPeriod.style.display = "none";
        }
    });

    // Submissão do formulário de filtro
    filterForm.addEventListener("submit", function(event) {
        event.preventDefault();
        generateReport(reportType.value, reportPeriod.value);
    });

    // Função para gerar o relatório
    function generateReport(type, period) {
        reportOutput.innerHTML = '';

        const formData = new FormData(filterForm);

        fetch(`../PHP/get_report.php?type=${type}&period=${period}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                displayReport(data.results, type);
            } else {
                reportOutput.innerHTML = `<p>Erro ao gerar relatório: ${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error('Erro ao gerar relatório:', error);
            reportOutput.innerHTML = `<p>Erro ao gerar relatório. Consulte o console para mais detalhes.</p>`;
        });
    }

    function displayReport(results, type) {
        if (type === 'vendas') {
            displaySalesReport(results);
        } else if (type === 'clientes') {
            displayClientsReport(results);
        } else if (type === 'produtos') {
            displayProductsReport(results);
        } else if (type === 'financeiro') {
            displayFinancialReport(results);
        }
    }

    function displaySalesReport(data) {
        const canvas = document.createElement('canvas');
        reportOutput.appendChild(canvas);

        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Vendas',
                    data: data.values,
                    backgroundColor: 'rgba(255, 94, 94, 0.2)',
                    borderColor: '#FF5E5E',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function displayClientsReport(data) {
        const table = document.createElement('table');
        table.classList.add('report-table');

        const headerRow = document.createElement('tr');
        const headers = ['Cliente', 'Total Compras', 'Última Compra'];
        headers.forEach(header => {
            const th = document.createElement('th');
            th.textContent = header;
            headerRow.appendChild(th);
        });
        table.appendChild(headerRow);

        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td>${row.cliente}</td><td>${row.total_compras}</td><td>${row.ultima_compra}</td>`;
            table.appendChild(tr);
        });

        reportOutput.appendChild(table);
    }

    function displayProductsReport(data) {
        // Similar to displayClientsReport, but for products
        const table = document.createElement('table');
        table.classList.add('report-table');

        const headerRow = document.createElement('tr');
        const headers = ['Produto', 'Quantidade Vendida', 'Total de Vendas'];
        headers.forEach(header => {
            const th = document.createElement('th');
            th.textContent = header;
            headerRow.appendChild(th);
        });
        table.appendChild(headerRow);

        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td>${row.produto}</td><td>${row.quantidade_vendida}</td><td>${row.total_vendas}</td>`;
            table.appendChild(tr);
        });

        reportOutput.appendChild(table);
    }

    function displayFinancialReport(data) {
        // Example for financial report
        const canvas = document.createElement('canvas');
        reportOutput.appendChild(canvas);

        new Chart(canvas, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Receitas e Despesas',
                    data: data.values,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: '#4BC0C0',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});