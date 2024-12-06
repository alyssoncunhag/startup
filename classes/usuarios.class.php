<?php
require_once 'conexao.class.php';
class Usuarios
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    /* permissoes: add, edit, del, super ou utilizar checkbox para isso */
    private $permissoes;

    private $con;

    public function __construct()
    {
        // Método construtor é o primeiro método a ser executado
        $this->con = new Conexao();
    }

    public function existeEmail($email)
    {
        $sql = $this->con->conectar()->prepare("SELECT id FROM usuarios WHERE email = :email");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(); //fetch retorna o email encontrado
        } else {
            $array = array();
        }
        return $array;
    }

    public function adicionar($email, $nome, $senha, $permissoes)
    {
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) == 0) {
            try {
                $this->nome = $nome;
                $this->senha = $senha;
                $this->permissoes = $permissoes;
                $this->email = $email;
                $sql = $this->con->conectar()->prepare("INSERT INTO usuarios(nome, email, senha, permissoes) VALUES 
                (:nome, :email, :senha, :permissoes)");

                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':senha', md5($senha));
                $sql->bindValue(':permissoes', $permissoes);
                $sql->execute();
                return TRUE;
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return FALSE;
        }
    }

    public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function buscar($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetch();
            } else {
                return array();
            }
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($nome, $email, $senha, $permissoes, $id)
    {
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) > 0 && $emailExistente['id'] != $id) {
            return FALSE;
        } else {
            try {
                $sql = $this->con->conectar()->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, permissoes = :permissoes WHERE id = :id");
                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':senha', md5($senha));
                $sql->bindValue(':permissoes', $permissoes);
                $sql->bindValue(':id', $id);

                $sql->execute();
                return TRUE;
            } catch (PDOException $ex) {
                echo 'ERRO' . $ex->getMessage();
            }
        }
    }

    public function deletar($id)
    {
        $sql = $this->con->conectar()->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function fazerLogin($email, $senha)
    {
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $usuario = $sql->fetch();

            // Verifica se a senha fornecida corresponde à senha hashada no banco de dados
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['logado'] = $usuario['id'];
                return TRUE;
            }
        }
        return FALSE;
    }
    public function setUsuario($id)
    {
        $this->id = $id;
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $this->permissoes = explode(', ', $sql['permissoes']); // Transforma em array
        }
    }
    public function getPermissoes()
    {
        return $this->permissoes;
    }
    public function temPermissoes($permissoes)
{
    // Verifica se as permissões passadas são uma string ou um array
    if (is_string($permissoes)) {
        $permissoes = explode(', ', $permissoes); // Transforma a string em um array
    }

    // Verifica se o usuário tem pelo menos uma das permissões
    foreach ($permissoes as $permissao) {
        if (in_array($permissao, $this->permissoes)) {
            return TRUE;
        }
    }

    return FALSE;
}

    public function verificarEmail($email)
    {
        $sql = $this->con->conectar()->prepare("SELECT id FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        return $sql->rowCount() > 0; // Verifica se encontrou o e-mail
    }


    // Atualiza a senha no banco
    public function atualizarSenha($email, $novaSenha)
    {
        $sql = $this->con->conectar()->prepare("UPDATE usuarios SET senha = :senha WHERE email = :email");
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT); // Usa o password_hash
        $sql->bindValue(":senha", $senhaHash); // Armazena a senha criptografada
        $sql->bindValue(":email", $email);
        return $sql->execute(); // Executa a atualização
    }
}
