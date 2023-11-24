// js/script.js

$(document).ready(function () {
    // Carregar a lista de tarefas ao carregar a página
    loadTaskList();


    // Exibir formulário create ao clicar no botão
    $('#add-task-button').on('click', function () {
        // Cria um contêiner modal do Bootstrap
        var container = $('<div>').addClass('modal fade');
        var dialog = $('<div>').addClass('modal-dialog');
        var content = $('<div>').addClass('modal-content');
    
        // Cria o formulário dentro do modal
        var form = $('<form>').addClass('centered-form');
        form.append('<span class="modal-title">Criar tarefa</span><br>');
    
        form.append('<label for="titulo">Título:</label>');
        form.append('<input type="text" id="titulo" class="form-control">');
        form.append('<br>');
        form.append('<label for="descricao">Descrição:</label>');
        form.append('<textarea id="descricao" class="form-control"></textarea>');
        form.append('<br>');
        form.append('<button id="save-btn" class="btn btn-primary">Salvar</button>');
        form.append('<button id="cancel-btn" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>');
    
        // Adiciona o formulário ao conteúdo do modal
        content.append(form);
        dialog.append(content);
        container.append(dialog);
    
        // Adiciona o modal ao corpo do documento e exibe
        $('body').append(container);
        container.modal('show');
    
        // Adicionar evento de clique para o botão de salvar
        form.find('#save-btn').on('click', function () {
            // Chamar a função de criação com os dados do formulário
            createTask($('#titulo').val(), $('#descricao').val());
    
            // Fechar o modal
            container.modal('hide');
        });
    
        // Adicionar evento de clique para o botão de cancelar
        form.find('#cancel-btn').on('click', function () {
            // Fechar o modal
            container.modal('hide');
        });
    });
    
    

    // Função para carregar a lista de tarefas
    function loadTaskList() {
        $.ajax({
            type: 'GET',
            url: '../Controller/Task/TaskController.php?action=index',
            success: function (response) {

                var data = JSON.parse(response);

                // Seletor do elemento onde será adicionado a tabela
                var tableContainer = $('#task-list');

                // Criar a tabela
                var table = $('<table>').addClass('table'); // class table

                // Cabeçalho da tabela
                var thead = $('<thead>').append(
                    $('<tr>').html('<th style="display: none;">ID</th><th>Título</th><th>Descrição</th><th>Ações</th>')
                );
                table.append(thead);

                // Corpo da tabela
                var tbody = $('<tbody>');
                $.each(data, function (index, task) {
                    var row = $('<tr>').html(
                        '<td style="display: none;">' + task.id + '</td>' +
                        '<td>' + task.titulo + '</td>' +
                        '<td>' + task.descricao + '</td>' +
                        '<td>' +
                        '<button class="btn btn-success edit-btn">Editar</button>' +
                        '<button class="btn btn-danger delete-btn">Deletar</button>' +
                        '</td>'
                    );
                    tbody.append(row);

                    // Adicionar eventos usando addEventListener
                    row.find('.edit-btn').on('click', function () {
                        // Abrir o formulário de edição
                        openEditForm(task);
                    });

                    row.find('.delete-btn').on('click', function () {
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

    //create task
    function createTask(titulo, descricao) {
        $.ajax({
            type: 'POST',
            url: '../Controller/Task/TaskController.php?action=create',
            data: {titulo: titulo, descricao: descricao},
            success: function (response) {
                // Recarregar a lista de tarefas após adicionar uma nova tarefa
                loadTaskList();

                // Limpar campos do formulário após adicionar a tarefa
                $('form').remove();
            },
            error: function () {
                alert('Erro ao adicionar tarefa.');
            }
        });
    }
    
    //Form update task
    function openEditForm(task) {
        // Cria um contêiner modal do Bootstrap
        var container = $('<div>').addClass('modal fade');
        var dialog = $('<div>').addClass('modal-dialog');
        var content = $('<div>').addClass('modal-content');
    
        // Cria o formulário dentro do modal
        var form = $('<form>').addClass('centered-form');
        form.append('<span class="modal-title">Editar Tarefa</span><br>');
    
        form.append('<label for="titulo">Título:</label>');
        form.append('<input type="text" id="titulo" value="' + task.titulo + '" class="form-control">');
        form.append('<br>');
        form.append('<label for="descricao">Descrição:</label>');
        form.append('<textarea id="descricao" class="form-control">' + task.descricao + '</textarea>');
        form.append('<br>');
        form.append('<button id="update-btn" class="btn btn-primary">Salvar</button>');
        form.append('<button id="cancel-btn" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>');
    
        // Adiciona o formulário ao conteúdo do modal
        content.append(form);
        dialog.append(content);
        container.append(dialog);
    
        // Adiciona o modal ao corpo do documento e exibe
        $('body').append(container);
        container.modal('show');
    
        // Adicionar evento de clique para o botão de atualização
        form.find('#update-btn').one('click', function () {
            // Chamar a função de atualização com os dados do formulário
            updateTask(task.id, $('#titulo').val(), $('#descricao').val());
    
            // Fechar o modal
            container.modal('hide');
        });
    
        // Adicionar evento de clique para o botão de cancelar
        form.find('#cancel-btn').on('click', function () {
            // Fechar o modal
            container.modal('hide');
        });
    }
    
    
    

    //Update Task
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


    // Delete Task
    function deleteTask(id) {
        // Confirmar novamente antes da exclusão
        var confirmDelete = confirm("Tem certeza que deseja excluir esta tarefa?");
        if (!confirmDelete) {
            return;
        }

        // Enviar a solicitação AJAX para excluir a tarefa
        $.ajax({
            type: 'POST',
            url: '../Controller/Task/TaskController.php?action=delete',
            data: { id: id },
            success: function (response) {
                // Recarregar a lista de tarefas após a exclusão
                loadTaskList();
            },
            error: function () {
                alert('Erro ao excluir tarefa.');
            }
        });
    }
});
