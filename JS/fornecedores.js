// Função para criar fornecedor
function criarFornecedor() {
    var nome = document.getElementById("nome").value;
    var contato = document.getElementById("contato").value;
    var telefone = document.getElementById("telefone").value;
    var email = document.getElementById("email").value;
    var endereco = document.getElementById("endereco").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../PHP/routes/fornecedor_handler.php?action=create", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("mensagem-criar").innerHTML = xhr.responseText;
            listarFornecedores(); // Atualiza a lista de fornecedores após criar
        }
    };

    xhr.send("nome=" + nome + "&contato=" + contato + "&telefone=" + telefone + "&email=" + email + "&endereco=" + endereco);
}

// Função para listar fornecedores
function listarFornecedores() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../PHP/routes/fornecedor_handler.php?action=read", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var fornecedores = JSON.parse(xhr.responseText);
            var listaFornecedores = document.getElementById("lista-fornecedores");
            listaFornecedores.innerHTML = "";

            fornecedores.records.forEach(function (fornecedor) {
                var li = document.createElement("li");
                li.textContent = fornecedor.id_fornecedor + ": " + fornecedor.nome + " - " + fornecedor.email;

                // Botão de Atualizar
                var btnAtualizar = document.createElement("button");
                btnAtualizar.textContent = "Atualizar";
                btnAtualizar.onclick = function () {
                    mostrarFormularioAtualizar(fornecedor);
                };

                // Botão de Excluir
                var btnExcluir = document.createElement("button");
                btnExcluir.textContent = "Excluir";
                btnExcluir.onclick = function () {
                    excluirFornecedor(fornecedor.id_fornecedor);
                };

                li.appendChild(btnAtualizar);
                li.appendChild(btnExcluir);
                listaFornecedores.appendChild(li);
            });
        }
    };

    xhr.send();
}

// Função para mostrar o formulário de atualização com dados preenchidos
function mostrarFormularioAtualizar(fornecedor) {
    document.getElementById("id_fornecedor").value = fornecedor.id_fornecedor;
    document.getElementById("nome-atualizar").value = fornecedor.nome;
    document.getElementById("contato-atualizar").value = fornecedor.contato;
    document.getElementById("telefone-atualizar").value = fornecedor.telefone;
    document.getElementById("email-atualizar").value = fornecedor.email;
    document.getElementById("endereco-atualizar").value = fornecedor.endereco;

    // Exibe o formulário de atualização
    document.getElementById("form-atualizar-fornecedor").style.display = "block";
}

// Função para atualizar fornecedor
function atualizarFornecedor() {
    var id_fornecedor = document.getElementById("id_fornecedor").value;
    var nome = document.getElementById("nome-atualizar").value;
    var contato = document.getElementById("contato-atualizar").value;
    var telefone = document.getElementById("telefone-atualizar").value;
    var email = document.getElementById("email-atualizar").value;
    var endereco = document.getElementById("endereco-atualizar").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../PHP/routes/fornecedor_handler.php?action=update", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("mensagem-atualizar").innerHTML = xhr.responseText;
            listarFornecedores(); // Atualiza a lista após a atualização
        }
    };

    xhr.send("id_fornecedor=" + id_fornecedor + "&nome=" + nome + "&contato=" + contato + "&telefone=" + telefone + "&email=" + email + "&endereco=" + endereco);
}

// Função para excluir fornecedor
function excluirFornecedor(id_fornecedor) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../PHP/routes/fornecedor_handler.php?action=delete", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
            listarFornecedores(); // Atualiza a lista após excluir
        }
    };

    xhr.send("id_fornecedor=" + id_fornecedor);
}
