<?php
require_once 'conexao.class.php';

class Torneios {
    private $id;
    private $nome;
    private $jogo;
    private $descricao;
    private $data_inicio;
    private $data_fim;

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    private function existeNome($nome) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT id FROM torneios WHERE nome = :nome");
            $sql->bindParam(':nome', $nome, PDO::PARAM_STR);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetch(); // Retorna o torneio encontrado
            }
            return array(); // Retorna vazio caso não encontre
        } catch (PDOException $ex) {
            echo 'Erro: ' . $ex->getMessage();
            return array();
        }
    }
    

    public function adicionar($nome, $jogo, $descricao, $data_inicio, $data_fim) {
        if (count($this->existeNome($nome)) > 0) {
            return "Já existe um torneio com este nome.";
        }
        
        try {
            $this->nome = $nome;
            $this->jogo = $jogo;
            $this->descricao = $descricao;
            $this->data_inicio = $data_inicio;
            $this->data_fim = $data_fim;
    
            $sql = $this->con->conectar()->prepare("
                INSERT INTO torneios (nome, jogo, descricao, data_inicio, data_fim)
                VALUES (:nome, :jogo, :descricao, :data_inicio, :data_fim)
            ");
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":jogo", $this->jogo, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $sql->bindParam(":data_inicio", $this->data_inicio, PDO::PARAM_STR);
            $sql->bindParam(":data_fim", $this->data_fim, PDO::PARAM_STR);
            $sql->execute();
    
            return TRUE;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }
    

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM torneios");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function buscar($id) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM torneios WHERE id = :id");
            $sql->bindValue(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            return ($sql->rowCount() > 0) ? $sql->fetch() : array();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function deletar($id) {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM torneios WHERE id = :id");
            $sql->bindValue(':id', $id, PDO::PARAM_INT);
            $sql->execute();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($nome, $jogo, $descricao, $data_inicio, $data_fim, $id) {
        try {
            $sql = $this->con->conectar()->prepare("
                UPDATE torneios
                SET nome = :nome, jogo = :jogo, descricao = :descricao, 
                    data_inicio = :data_inicio, data_fim = :data_fim
                WHERE id = :id
            ");
            $sql->bindParam(":nome", $nome, PDO::PARAM_STR);
            $sql->bindParam(":jogo", $jogo, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $sql->bindParam(":data_inicio", $data_inicio, PDO::PARAM_STR);
            $sql->bindParam(":data_fim", $data_fim, PDO::PARAM_STR);
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            return TRUE;
        } catch (PDOException $ex) {
            echo 'Erro: ' . $ex->getMessage();
            return FALSE;
        }
    }
}
?>
