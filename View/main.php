<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>

    <!--Jquery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        #add-task-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #add-task-form {
            display: none;
            position: fixed;
            bottom: 50px;
            right: 20px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <h1>Tarefas</h1>
        <ul id="task-list">
            <!-- Os registros da tabela task serão exibidos aqui -->
        </ul>

        <!-- Botão para abrir o formulário -->
        <button id="add-task-button">Adicionar Tarefa</button>

        <!-- Formulário para adicionar tarefa -->
        <div id="add-task-form">
            <h3>Adicionar Tarefa</h3>
            <form id="ajax-form">
                <label for="task-name">Nome da Tarefa:</label>
                <input type="text" id="task-name" name="task_name" required>

                <!-- Adicione um campo para a descrição da tarefa -->
                <label for="task-description">Descrição da Tarefa:</label>
                <textarea id="task-description" name="task_description" rows="4" required></textarea>

                <button type="submit">Criar</button>
                <button id="cancel-task-button">Cancelar</button>
            </form>
        </div>
    <script src="../Controller/js/script.js"></script>

</body>

</html>