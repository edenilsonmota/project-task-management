// js/script.js

$(document).ready(function () {
    // Carregar a lista de tarefas ao carregar a página
    loadTaskList();

    // Exibir formulário ao clicar no botão
    $('#add-task-button').click(function () {
        $('#add-task-form').toggle();
    });

    // Ocultar formulário ao clicar no botão "Cancelar"
    $('#cancel-task-button').click(function () {
        $('#add-task-form').hide();
    });

    // Enviar o formulário AJAX ao adicionar uma tarefa
    $('#ajax-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '../Controller/Task/TaskController.php?action=create',
            data: $(this).serialize(),
            success: function (response) {
                // Recarregar a lista de tarefas após adicionar uma nova tarefa
                loadTaskList();

                // Limpar campos do formulário após adicionar a tarefa
                $('#task-name').val('');
                $('#task-description').val('');
            },
            error: function () {
                alert('Erro ao adicionar tarefa.');
            }
        });
    });


// Função para carregar a lista de tarefas
function loadTaskList() {
    $.ajax({
        type: 'GET',
        url: '../Controller/Task/TaskController.php?action=index',
        success: function (response) {
            // Caso que o 'response' seja um JSON
            var data = JSON.parse(response);

            // Seletor do elemento onde será adicionado a tabela
            var tableContainer = $('#task-list');

            // Criar a tabela
            var table = $('<table>').addClass('table'); // class table

            // Cabeçalho da tabela
            var thead = $('<thead>').append(
                $('<tr>').html('<th>ID</th><th>Título</th><th>Descrição</th><th>Ações</th>')
            );
            table.append(thead);

            // Corpo da tabela
            var tbody = $('<tbody>');
            $.each(data, function (index, task) {
                var row = $('<tr>').html(
                    '<td>' + task.id + '</td>' +
                    '<td>' + task.titulo + '</td>' +
                    '<td>' + task.descricao + '</td>' +
                    '<td>' +
                        '<button class="edit-btn">Editar</button>' +
                        '<button class="delete-btn">Deletar</button>' +
                    '</td>'
                );
                tbody.append(row);

                // Adicionar eventos usando addEventListener
                row.find('.edit-btn').on('click', function() {
                    // Abrir o formulário de edição
                    openEditForm(task);
                });

                row.find('.delete-btn').on('click', function() {
                    deleteTask(task.id);
                });
            });

            table.append(tbody);

            // Limpar e adicionar a tabela ao contêiner
            tableContainer.html(table);
        },
        error: function () {
            alert('Erro ao carregar a lista de tarefas.');
        }
    });
}

function openEditForm(task) {
    // Exemplo de formulário de edição
    var form = $('<form>');
    form.append('<label for="titulo">Título:</label>');
    form.append('<input type="text" id="titulo" value="' + task.titulo + '">');
    form.append('<br>');
    form.append('<label for="descricao">Descrição:</label>');
    form.append('<textarea id="descricao">' + task.descricao + '</textarea>');
    form.append('<br>');
    form.append('<button id="update-btn">Salvar</button>');
    form.append('<button id="cancel-btn">Cancelar</button>');

    // Adicionar o formulário ao corpo do documento
    $('body').append(form);

    // Adicionar evento de clique para o botão de atualização
    form.find('#update-btn').on('click', function() {
        // Chamar a função de atualização com os dados do formulário
        updateTask(task.id, $('#titulo').val(), $('#descricao').val());
    });

    // Adicionar evento de clique para o botão de cancelar
    form.find('#cancel-btn').on('click', function() {

        // Remover o formulário sem fazer a atualização
        form.remove();
    });
}

function updateTask(id, titulo, descricao) {
    // Enviar dados para o servidor usando AJAX
    $.ajax({
        type: 'POST',
        url: '../Controller/Task/TaskController.php?action=update',
        data: { id: id, titulo: titulo, descricao: descricao },
        success: function (response) {
            // Recarregar a lista de tarefas após a atualização
            loadTaskList();

            // Remover o formulário de edição após a atualização
            $('form').remove();
        },
        error: function () {
            alert('Erro ao atualizar tarefa.');
        }
    });
}


// Função de exemplo para deleteTask
function deleteTask(taskId) {
    // Implemente a lógica de exclusão aqui
    console.log(taskId);
}

});
