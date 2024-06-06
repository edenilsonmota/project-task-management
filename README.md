# crud-tarefas

Este é um projeto de CRUD de tarefas, foi feito como desafio proposto pela empresa Inforgeneses, desenvolvido usando a arquitetura MVC (Model-View-Controller) e tecnologias como Bootstrap, JavaScript, jQuery (Ajax), PHP e MySQL.

## Pré-requisitos

- Servidor web (ex: Apache)
- PHP
- MySQL

## Instalação

1. Clone este repositório para o seu servidor web(OBRIGATORIO)
2. Importar base de dados com backup.sql(OBRIGATORIO)

    ```bash
    cd /LOCAL_SERVIDOR/
    mysql -u USUARIO -p < backup.sql
    ```

3. No arquivo App/Config/Database.php e App/Config/config.php, alterar $user, $pass, $db_name, $host de acordo com suas configurações(OBRIGATORIO).

   ```php
    //Database.php
    private $host = 'localhost';
    private $db_name = 'system_task';
    private $user = 'root';
    private $pass = '12345';
    protected $conn;

    //config.php
    //nome do projeto
    define("PROJECT_NAME", "system-task");
   ```

## Funcionalidades

- Login por usuario.
- Criação, leitura, atualização e exclusão de tarefas.
- Interface responsiva usando Bootstrap.
- Comunicação assíncrona com o servidor usando jQuery Ajax.
- Arquitetura MVC para organização e manutenção do código.

## Screenshot

<img src="screenshot/Screenshot1.png" alt="READ" width="500"/>
<img src="screenshot/Screenshot2.png" alt="CREATE" width="500"/>
<img src="screenshot/Screenshot3.png" alt="UPDATE" width="500"/>
<img src="screenshot/Screenshot4.png" alt="DELETE" width="500"/>
