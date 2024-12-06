<?php
require_once 'conexao.class.php';

class Times {
    private $id;
    private $nome;
    private $pais;
    private $descricao;
    private $imagem;

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    private function existeNome($nome) {
        $sql = $this->con->conectar()->prepare("SELECT id FROM times WHERE nome = :nome");
        $sql->bindParam(':nome', $nome, PDO::PARAM_STR);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        }
        return array();
    }

    public function adicionar($nome, $pais, $descricao, $imagem) {
        $nomeExistente = $this->existeNome($nome);
        if (count($nomeExistente) == 0) {
            try {
                $this->nome = $nome;
                $this->pais = $pais;
                $this->descricao = $descricao;
                $this->imagem = $imagem;

                $sql = $this->con->conectar()->prepare("INSERT INTO times(nome, pais, descricao, imagem) VALUES (:nome, :pais, :descricao, :imagem)");
                $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                $sql->bindParam(":pais", $this->pais, PDO::PARAM_STR);
                $sql->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
                $sql->bindParam(":imagem", $this->imagem, PDO::PARAM_STR);
                $sql->execute();

                return TRUE;
            } catch(PDOException $ex) {
                return 'ERRO: '.$ex->getMessage();
            }
        }
        return FALSE; // Nome já existe
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM times");
            $sql->execute();
            return $sql->fetchAll();
        } catch(PDOException $ex) {
            echo "ERRO: ". $ex->getMessage();
        }
    }

    public function buscar($id) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM times WHERE id=:id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            return ($sql->rowCount() > 0) ? $sql->fetch() : array();
        } catch(PDOException $ex) {
            echo "ERRO: ".$ex->getMessage();
        }
    }

    public function getImagem() {
        $array = array();
        $sql = $this->con->conectar()->prepare("
            SELECT t.*, i.url 
            FROM times t
            LEFT JOIN imagem_time i ON i.id_time = t.id
        ");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function deletar($id){
        $sql = $this->con->conectar()->prepare("DELETE FROM times WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function editar($nome, $pais, $descricao, $imagem, $id) {
        $nomeExistente = $this->existeNome($nome);
        if (count($nomeExistente) > 0 && $nomeExistente['id'] != $id) {
            return FALSE; // Nome já existe para outro time
        } else {
            try {
                $sql = $this->con->conectar()->prepare("UPDATE times SET nome = :nome, pais = :pais, descricao = :descricao, imagem = :imagem WHERE id = :id");
                $sql->bindParam(":nome", $nome, PDO::PARAM_STR);
                $sql->bindParam(":pais", $pais, PDO::PARAM_STR);
                $sql->bindParam(":descricao", $descricao, PDO::PARAM_STR);
                $sql->bindParam(":imagem", $imagem, PDO::PARAM_STR);
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
