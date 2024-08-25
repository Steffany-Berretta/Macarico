// Arquivo: encomendas.js

function adicionarItem() {
    var itemDiv = document.createElement("div");
    itemDiv.classList.add("item-encomenda");

    var idProdutoInput = document.createElement("input");
    idProdutoInput.type = "number";
    idProdutoInput.placeholder = "ID do Produto";
    itemDiv.appendChild(idProdutoInput);

    var idFornecedorInput = document.createElement("input");
    idFornecedorInput.type = "number";
    idFornecedorInput.placeholder = "ID do Fornecedor";
    itemDiv.appendChild(idFornecedorInput);

    var quantidadeInput = document.createElement("input");
    quantidadeInput.type = "number";
    quantidadeInput.placeholder = "Quantidade";
    itemDiv.appendChild(quantidadeInput);

    var precoUnitarioInput = document.createElement("input");
    precoUnitarioInput.type = "number";
    precoUnitarioInput.step = "0.01";
    precoUnitarioInput.placeholder = "Preço Unitário";
    itemDiv.appendChild(precoUnitarioInput);

    document.getElementById("itens-encomenda").appendChild(itemDiv);
}

function criarEncomenda() {
    var id_cliente = document.getElementById("id_cliente").value;
    var data_encomenda = document.getElementById("data_encomenda").value;
    var status = document.getElementById("status").value;
    var valor_total = document.getElementById("valor_total").value;

    var itens = [];
    document.querySelectorAll("#itens-encomenda .item-encomenda").forEach(function(item) {
        var id_produto = item.children[0].value;
        var id_fornecedor = item.children[1].value;
        var quantidade = item.children[2].value;
        var preco_unitario = item.children[3].value;

        itens.push({
            id_produto: id_produto,
            id_fornecedor: id_fornecedor,
            quantidade: quantidade,
            preco_unitario: preco_unitario
        });
    });

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../PHP/routes/encomenda_handler.php?action=create", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("mensagem-criar").innerHTML = xhr.responseText;
        }
    };

    var data = JSON.stringify({
        id_cliente: id_cliente,
        data_encomenda: data_encomenda,
        status: status,
        valor_total: valor_total,
        itens: itens
    });

    xhr.send(data);
}

// Similar functions for listarEncomendas, atualizarEncomenda, etc.
