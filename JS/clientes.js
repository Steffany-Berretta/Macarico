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

                // Botão de Atualizar
                var btnAtualizar = document.createElement("button");
                btnAtualizar.textContent = "Atualizar";
                btnAtualizar.style.marginLeft = "10px";
                btnAtualizar.onclick = function () {
                    mostrarFormularioAtualizar(cliente);
                };

                // Botão de Excluir
                var btnExcluir = document.createElement("button");
                btnExcluir.textContent = "Excluir";
                btnExcluir.style.marginLeft = "10px";
                btnExcluir.onclick = function () {
                    excluirCliente(cliente.id_cliente);
                };

                li.appendChild(btnAtualizar);
                li.appendChild(btnExcluir);
                listaClientes.appendChild(li);
            });
        }
    };

    xhr.send();
}

function mostrarFormularioAtualizar(cliente) {
    console.log(cliente);  // Log para garantir que os dados do cliente estão corretos

    var idClienteInput = document.getElementById("id_cliente");
    var nomeInput = document.getElementById("nome-atualizar");
    var telefoneInput = document.getElementById("telefone-atualizar");
    var emailInput = document.getElementById("email-atualizar");
    var enderecoInput = document.getElementById("endereco-atualizar");
    var cpfCnpjInput = document.getElementById("cpf_cnpj-atualizar");

    // Verifica se todos os elementos foram encontrados
    if (!idClienteInput || !nomeInput || !telefoneInput || !emailInput || !enderecoInput || !cpfCnpjInput) {
        console.error("Um ou mais elementos do formulário não foram encontrados.");
        return;
    }

    // Preenche os campos do formulário de atualização com os dados do cliente
    idClienteInput.value = cliente.id_cliente;
    nomeInput.value = cliente.nome;
    telefoneInput.value = cliente.telefone;
    emailInput.value = cliente.email;
    enderecoInput.value = cliente.endereco;
    cpfCnpjInput.value = cliente.cpf_cnpj;

    // Exibe a seção do formulário de atualização
    document.getElementById("form-atualizar-cliente").style.display = "block";
}

function excluirCliente(id_cliente) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../PHP/routes/cliente_handler.php?action=delete", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
            listarClientes(); // Atualiza a lista após excluir
        }
    };

    xhr.send("id_cliente=" + id_cliente);
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
            listarClientes();  // Recarrega a lista de clientes após a atualização
        }
    };

    xhr.send("id_cliente=" + id_cliente + "&nome=" + nome + "&telefone=" + telefone + "&email=" + email + "&endereco=" + endereco + "&cpf_cnpj=" + cpf_cnpj);
}
