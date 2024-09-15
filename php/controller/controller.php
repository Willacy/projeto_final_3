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

    // Função para Logout
    public function logout()
    {
        $_SESSION["validar"] = false;
        $_SESSION["mensagem"] = "Logout Efetuado!";
        //header('Location: /projeto_final_3/login');
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

    public function buscarUsuarioPorId($id_usuario)
    {
        try {
            $query = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            echo "Erro ao pesquisar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarUsuario($id_usuario, $nome_usuario, $login_usuario, $senha_usuario)
    {
        try {
            $query = "UPDATE usuarios SET nome_usuario = :nome_usuario, login_usuario = :login_usuario, senha_usuario = :senha_usuario WHERE id_usuario = :id_usuario";
            $stmt = $this->conexao->prepare($query);


            // Bind dos parâmetros individualmente
            $stmt->bindParam(':nome_usuario', $nome_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':login_usuario', $login_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':senha_usuario', $senha_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao atualizar usuário: " . $e->getMessage();
            return false;
        }
    }

    // Função para excluir um usuário
    public function excluirUsuario($id_usuario)
    {
        try {
            $query = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir usuário: " . $e->getMessage();
            return false;
        }
    }

    public function registrarLivro()
    {
        try {
            // Recebendo os valores do formulário
            $titulo_livro = $_POST['titulo_livro'];
            $valor_venda_livro = $_POST['valor_venda_livro'];
            $valor_aluguel_livro = $_POST['valor_aluguel_livro'];
            $isbn_livro = $_POST['isbn_livro'];
            $quantidade_livro = $_POST['quantidade_livro'];

            // Query para inserir o livro no banco de dados
            $query = "INSERT INTO livros (titulo_livro, valor_venda_livro, valor_aluguel_livro, isbn_livro, quantidade_livro) 
                      VALUES (:titulo_livro, :valor_venda_livro, :valor_aluguel_livro, :isbn_livro, :quantidade_livro)";
            $stmt = $this->conexao->prepare($query);

            // Vinculando os parâmetros corretamente
            $stmt->bindParam(':titulo_livro', $titulo_livro);
            $stmt->bindParam(':valor_venda_livro', $valor_venda_livro);
            $stmt->bindParam(':valor_aluguel_livro', $valor_aluguel_livro);
            $stmt->bindParam(':isbn_livro', $isbn_livro);
            $stmt->bindParam(':quantidade_livro', $quantidade_livro);

            // Executando a query
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }

    }

}