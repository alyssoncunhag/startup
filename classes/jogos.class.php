<?php
require_once 'conexao.class.php';

class Jogos {
    private $id;
    private $nome;
    private $descricao;
    private $data_lancamento;
    private $imagem;

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    private function existeNome($nome) {
        $sql = $this->con->conectar()->prepare("SELECT id FROM jogos WHERE nome = :nome");
        $sql->bindParam(':nome', $nome, PDO::PARAM_STR);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        }
        return array();
    }

    public function adicionar($nome, $descricao, $data_lancamento, $imagem) {
        try {
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->data_lancamento = $data_lancamento;
            $this->imagem = $imagem;
    
            $sql = $this->con->conectar()->prepare("INSERT INTO jogos (nome, descricao, data_lancamento, imagem) VALUES (:nome, :descricao, :data_lancamento, :imagem)");
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $sql->bindParam(":data_lancamento", $this->data_lancamento, PDO::PARAM_STR);
            $sql->bindParam(":imagem", $this->imagem, PDO::PARAM_STR);
            $sql->execute();
    
            return TRUE;
        } catch(PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return FALSE;
        }
    }
    
    
    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM jogos");
            $sql->execute();
            return $sql->fetchAll();
        } catch(PDOException $ex) {
            echo "ERRO: ". $ex->getMessage();
        }
    }

    public function buscar($id) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM jogos WHERE id=:id");
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
            SELECT j.*, i.url 
            FROM jogos j
            LEFT JOIN imagem_jogo i ON i.id_jogo = j.id
        ");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function deletar($id){
        $sql = $this->con->conectar()->prepare("DELETE FROM jogos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function editar($nome, $descricao, $data_lancamento, $imagem, $id) {
        $nomeExistente = $this->existeNome($nome);
        if (count($nomeExistente) > 0 && $nomeExistente['id'] != $id) {
            return FALSE;
        } else {
            try {
                $sql = $this->con->conectar()->prepare("UPDATE jogos SET nome = :nome, descricao = :descricao, data_lancamento = :data_lancamento, imagem = :imagem WHERE id = :id");
                $sql->bindParam(":nome", $nome, PDO::PARAM_STR);
                $sql->bindParam(":descricao", $descricao, PDO::PARAM_STR);
                $sql->bindParam(":data_lancamento", $data_lancamento, PDO::PARAM_STR);
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
