<?php

namespace DB;

use PDO;
use PDOException;
use InvalidArgumentException;

class Conn
{
    private object $conexao;

    public function __construct()
    {
        $this->conexao = $this->setConn();
    }


    /**
     * function conexão com banco de dados
     * Alterar constantes no arquivo config.php
     * @return void
     */
    private function setConn() : PDO
    {
        try {
            return new PDO(
                'mysql:host=' . HOST . '; dbname=' . DB . ';',
                USER,
                PASS
            );
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }
    /**
     * Listar(SELECT) todos os registros
     *
     * @return array
     */
    public function getAll() : array
    {
        try {
            $query = $this->conexao->query("SELECT * FROM task");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    /**
     * Listar(SELECT) tum registro por id
     *
     * @param integer $id
     * 
     */
    public function getOneByKey(int $id)
    {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM task WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Erro ao executar a consulta: " . $exception->getMessage();
        }
    }

    /**
     * Inserir SQL task
     *
     * @param string $titulo
     * @param string $descricao
     * 
     */
    public function insert(string $titulo, string $descricao)
    {
        try {
            $stmt = $this->conexao->prepare("INSERT INTO task (titulo, descricao) VALUES (:titulo, :descricao)");
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->execute();

            echo "Inserção bem-sucedida!";
        } catch (PDOException $exception) {
            echo "Erro ao executar a inserção: " . $exception->getMessage();
        }
    }

    /**
     * Update SQL task
     *
     * @param integer $id
     * @param string $titulo
     * @param string $descricao
     * 
     */
    public function update(int $id, string $titulo, string $descricao)
    {
        try {
            $stmt = $this->conexao->prepare("UPDATE task SET titulo = :titulo, descricao = :descricao WHERE id = :id");
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "Atualização bem-sucedida!";
        } catch (PDOException $exception) {
            echo "Erro ao executar a atualização: " . $exception->getMessage();
        }
    }

    /**
     * Update SQL task
     *
     * @param int $id
     * 
     */
    public function delete(int $id)
    {
        try {
            $stmt = $this->conexao->prepare("DELETE FROM task WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "Exclusão bem-sucedida!";
        } catch (PDOException $exception) {
            echo "Erro ao executar a exclusão: " . $exception->getMessage();
        }
    }




}
