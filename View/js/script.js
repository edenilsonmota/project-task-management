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
// Função para carregar a lista de tarefas
function loadTaskList() {
    $.ajax({
        type: 'GET',
        url: '../Controller/Task/TaskController.php?action=index',
        success: function (response) {
            // Caso que o 'response' seja um JSON
            var data = JSON.parse(response);

            // Seletor do elemento onde será adicionado a  tabela
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
                        '<button onclick="updateTask(' + task.id + ')">Editar</button>' +
                        '<button onclick="deleteTask(' + task.id + ')">Deletar</button>' +
                    '</td>'
                );
                tbody.append(row);
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

// Função de exemplo para updateTask
function updateTask(taskId) {
    // Implemente a lógica de atualização aqui
    console.log('Update task with ID: ' + taskId);
}

// Função de exemplo para deleteTask
function deleteTask(taskId) {
    // Implemente a lógica de exclusão aqui
    console.log('Delete task with ID: ' + taskId);
}

});
