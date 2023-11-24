<?php

namespace DB;

use PDO;
use PDOException;

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
     * @return array
     */
    public function getAll() : array
    {
        $query = $this->conexao->query("SELECT * FROM task ORDER BY id DESC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Listar(SELECT) tum registro por id
     * @param integer $id
     * @return array
     */
    public function getOneByKey(int $id) : array
    {
        $stmt = $this->conexao->prepare("SELECT * FROM task WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Inserir SQL task
     * @param string $titulo
     * @param string $descricao
     * @return bool
     */
    public function insert(string $titulo, string $descricao)
    {
        $stmt = $this->conexao->prepare("INSERT INTO task (titulo, descricao) VALUES (:titulo, :descricao)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    /**
     * Update SQL task
     * @param integer $id
     * @param string $titulo
     * @param string $descricao
     * @return bool
     */
    public function update(int $id, string $titulo, string $descricao)
    {
        $stmt = $this->conexao->prepare("UPDATE task SET titulo = :titulo, descricao = :descricao WHERE id = :id");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Update SQL task
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $stmt = $this->conexao->prepare("DELETE FROM task WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }




}
