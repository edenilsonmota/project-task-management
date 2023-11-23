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
                $('#task-list').html(response);
            },
            error: function () {
                alert('Erro ao carregar a lista de tarefas.');
            }
        });
    }
});
