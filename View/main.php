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

    </style>
</head>

<body>
    <h1>Lista de Tarefas</h1>
    <span id="task-list"></span>
        <!-- Botão para abrir o formulário -->
    <button id="add-task-button">Adicionar Tarefa</button>

    <script src="../View/js/script.js"></script>

</body>

</html>