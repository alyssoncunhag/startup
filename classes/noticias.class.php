<?php
require_once 'conexao.class.php';

class Noticias {
    private $id;
    private $titulo;
    private $autor;
    private $categoria;

    private $conteudo;
    private $data_publicacao;
    private $imagem;

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    private function existeTitulo(){
        $sql = $this->con->conectar()->prepare("SELECT id FROM noticias WHERE titulo = :titulo");
        $sql->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $sql->execute();
        if( $sql->rowCount() > 0){
            return $sql->fetch();
        }
        return array();
    }

    public function adicionar($titulo, $autor, $categoria, $conteudo, $data_publicacao, $imagem){
        $tituloExistente = $this->existeTitulo($titulo);
        if(count($tituloExistente) == 0){
            try{
                $this->titulo = $titulo;
                $this->autor = $autor;
                $this->categoria = $categoria;
                $this->conteudo = $conteudo;
                $this->data_publicacao = $data_publicacao;
                $this->imagem = $imagem;

                $sql = $this ->con->conectar()->prepare("INSERT INTO noticias(titulo, autor, categoria, conteudo, data_publicacao, imagem) VALUES (:titulo, :autor, :categoria, :conteudo, :data_publicacao, :imagem");
                $sql->bindParam(":titulo", $this->titulo, PDO::PARAM_STR);
                $sql->bindParam(":autor", $this->autor, PDO::PARAM_STR);
                $sql->bindParam(":categoria", $categoria, PDO::PARAM_STR);
                $sql->bindParam(":conteudo", $this->conteudo, PDO::PARAM_STR);
                $sql->bindParam(":data_publicacao", $this->data_publicacao, PDO::PARAM_STR);
                $sql->bindParam(":imagem", $this->imagem, PDO::PARAM_STR);
                $sql->execute();

                return TRUE;
            } catch(PDOException $ex){
                return 'ERRO: '.$ex->getMessage();
            }
        }
        return FALSE;
    }

    public function listar(){
        try{
            $sql = $this->con->conectar()->prepare("SELECT * FROM noticias");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex){
            echo "ERRO: ".$ex->getMessage();
        }
    }

    public function buscar($id){
        try{
            $sql = $this->con->conectar()->prepare("SELECT * FROM noticias WHERE id=:id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            return($sql->rowCount() > 0) ? $sql->fetch() : array();
        } catch (PDOException $ex){
            echo 'ERRO: '.$ex->getMessage();
        }
    }
    
    public function getImagem(){
        $array = array();
        $sql = $this->con->conectar()->prepare("SELECT n.*, i.url FROM noticias n LEFT JOIN imagem_noticia i ON i.id_contato = n.id");
        $sql->execute();
        if($sql->rowCount() > 0){
            $array =  $sql->fetchAll();
        }
        return $array;
    }

    public function deletar($id){
        $sql = $this->con->conectar()->prepare("DELETE FROM noticias WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function editar($titulo, $autor, $categoria, $conteudo, $data_publicacao, $imagem, $id){
        $tituloExistente = $this->existeTitulo($titulo);
        if (count($tituloExistente) > 0 && $tituloExistente['id'] != $id){
            return FALSE;
        } else{
            try{
                $sql = $this->con->conectar()->prepare("UPDATE noticias SET titulo = :titulo, autor = :autor, categoria = :categoria, conteudo = :conteudo, data_publicacao =  :data_publicacao, imagem = :imagem WHERE id = :id");

                $sql->bindParam(":titulo", $titulo, PDO::PARAM_STR);
                $sql->bindParam(":autor", $autor, PDO::PARAM_STR);
                $sql->bindParam(":categoria", $categoria, PDO::PARAM_STR);
                $sql->bindParam(":conteudo", $conteudo, PDO::PARAM_STR);
                $sql->bindParam("data_publicacao", $data_publicaco, PDO::PARAM_STR);
                $sql->bindParam(":imagem", $imagem, PDO::PARAM_STR);
                $sql->bindParam(":id", $id, PDO::PARAM_STR);
                $sql->execute();
                return TRUE;
            } catch (PDOException $ex) {
                echo 'ERRO: ' . ex->getMessage();
                return FALSE;
            }
        }
    }
} 