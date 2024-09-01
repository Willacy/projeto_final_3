<?php

class Conexao
{
    protected $conexao = null;

    public function __construct()
    {
        try {
            $this->conexao = new PDO('mysql:host=localhost;dbname=bd_biblioteca;port=3306', 'root', '');
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
    }

    public function getConexao()
    {
        return $this->conexao;
    }
}

class ControllerUser extends Conexao
{

    // Função para validar o login
    public function validarLogin()
    {
        $login_usuario = $_POST['login'];
        $senha_usuario = sha1($_POST['senha']);

        $query = "SELECT * FROM usuarios WHERE login_usuario = :login_usuario";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(":login_usuario", $login_usuario);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && $senha_usuario === $usuario['senha_usuario']) {
            $_SESSION["validar"] = true;
            $_SESSION["mensagem"] = "Login Efetuado!";
            header('Location: /projeto_final_3/home');  // Redireciona para a tela principal
            exit();
        } else {
            // Login inválido
            return false;
        }
    }

    // Função para registrar um novo usuário
    public function registrarUsusario()
    {
        try {
            $nome_usuario = $_POST['nome_usuario'];
            $login_usuario = $_POST['login_usuario'];
            $senha_usuario = sha1($_POST['senha_usuario']);

            $query = "INSERT INTO usuarios (nome_usuario, login_usuario, senha_usuario) VALUES (:nome_usuario, :login_usuario, :senha_usuario)";
            $stmt = $this->conexao->prepare($query);

            $stmt->bindParam(':nome_usuario', $nome_usuario);
            $stmt->bindParam(':login_usuario', $login_usuario);
            $stmt->bindParam(':senha_usuario', $senha_usuario);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

     // Função para pesquisar um usuário
     public function pesquisarUsuario($criterio)
     {
         try {
             $query = "SELECT * FROM usuarios WHERE nome_usuario LIKE :criterio OR login_usuario LIKE :criterio";
             $stmt = $this->conexao->prepare($query);
             $criterio = '%' . $criterio . '%';
             $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);
             $stmt->execute();
 
             $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
             return $resultados;
 
         } catch (PDOException $e) {
             echo "Erro ao pesquisar usuário: " . $e->getMessage();
             return false;
         }
     }

}