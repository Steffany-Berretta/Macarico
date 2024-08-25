// Arquivo: clientes.js

function criarCliente() {
    var nome = document.getElementById("nome").value;
    var telefone = document.getElementById("telefone").value;
    var email = document.getElementById("email").value;
    var endereco = document.getElementById("endereco").value;
    var cpf_cnpj = document.getElementById("cpf_cnpj").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../PHP/routes/cliente_handler.php?action=create", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("mensagem-criar").innerHTML = xhr.responseText;
        }
    };

    xhr.send("nome=" + nome + "&telefone=" + telefone + "&email=" + email + "&endereco=" + endereco + "&cpf_cnpj=" + cpf_cnpj);
}

function listarClientes() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../PHP/routes/cliente_handler.php?action=read", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var clientes = JSON.parse(xhr.responseText);
            var listaClientes = document.getElementById("lista-clientes");
            listaClientes.innerHTML = "";

            clientes.records.forEach(function (cliente) {
                var li = document.createElement("li");
                li.textContent = cliente.id_cliente + ": " + cliente.nome + " - " + cliente.email;
                listaClientes.appendChild(li);
            });
        }
    };

    xhr.send();
}

function atualizarCliente() {
    var id_cliente = document.getElementById("id_cliente").value;
    var nome = document.getElementById("nome-atualizar").value;
    var telefone = document.getElementById("telefone-atualizar").value;
    var email = document.getElementById("email-atualizar").value;
    var endereco = document.getElementById("endereco-atualizar").value;
    var cpf_cnpj = document.getElementById("cpf_cnpj-atualizar").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../PHP/routes/cliente_handler.php?action=update", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("mensagem-atualizar").innerHTML = xhr.responseText;
        }
    };

    xhr.send("id_cliente=" + id_cliente + "&nome=" + nome + "&telefone=" + telefone + "&email=" + email + "&endereco=" + endereco + "&cpf_cnpj=" + cpf_cnpj);
}

function excluirCliente() {
    var id_cliente = document.getElementById("id_cliente-excluir").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../PHP/routes/cliente_handler.php?action=delete", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("mensagem-excluir").innerHTML = xhr.responseText;
        }
    };

    xhr.send("id_cliente=" + id_cliente);
}
