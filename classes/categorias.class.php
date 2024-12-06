<?php
require_once 'conexao.class.php';

class Categorias {
    private $id;
    private $nome;
    private $descricao;

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    private function existeNome($nome) {
        $sql = $this->con->conectar()->prepare("SELECT id FROM categorias WHERE nome = :nome");
        $sql->bindParam(':nome', $nome, PDO::PARAM_STR);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        }
        return array();
    }

    public function adicionar($nome, $descricao) {
        $nomeExistente = $this->existeNome($nome);
        if (count($nomeExistente) == 0) {
            try {
                $this->nome = $nome;
                $this->descricao = $descricao;

                $sql = $this->con->conectar()->prepare("INSERT INTO categorias(nome, descricao) VALUES (:nome, :descricao)");
                $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                $sql->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
                $sql->execute();

                return TRUE;
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        }
        return FALSE;
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM categorias");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function buscar($id) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM categorias WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            return ($sql->rowCount() > 0) ? $sql->fetch() : array();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function deletar($id) {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM categorias WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($nome, $descricao, $id) {
        $nomeExistente = $this->existeNome($nome);
        if (count($nomeExistente) > 0 && $nomeExistente['id'] != $id) {
            return FALSE;
        } else {
            try {
                $sql = $this->con->conectar()->prepare("UPDATE categorias SET nome = :nome, descricao = :descricao WHERE id = :id");
                $sql->bindParam(":nome", $nome, PDO::PARAM_STR);
                $sql->bindParam(":descricao", $descricao, PDO::PARAM_STR);
                $sql->bindParam(":id", $id);
                $sql->execute();
                return TRUE;
            } catch (PDOException $ex) {
                echo 'Erro: ' . $ex->getMessage();
                return FALSE;
            }
        }
    }
}
