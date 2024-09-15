<?php
require_once './controller.php';
class ControllerUsuario extends Conexao
{
    public function criarUsuario($nome_usuario, $login_usuario, $senha_usuario)
    {
        try {
            // Hash da senha do usuário
            $senha_sha1 = sha1($senha_usuario);

            // Query
            $query = "INSERT INTO usuarios (nome_usuario, login_usuario, senha_usuario, ativo_usuario) 
                      VALUES (:nome_usuario, :login_usuario, :senha_usuario, true)";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':nome_usuario', $nome_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':login_usuario', $login_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':senha_usuario', $senha_sha1, PDO::PARAM_STR);

            // Executa a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao criar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarUsuario($criterio)
    {
        try {
            // Query
            $query = "SELECT * FROM usuarios WHERE login_usuario = :criterio";
            $stmt = $this->conexao->prepare($query);
            $criterio = '%' . $criterio . '%';

            // Bind dos parâmetros
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);

            // Executa a query
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarUsuario($id_usuario, $nome_usuario, $login_usuario, $senha_usuario = null, $ativo_usuario = true)
    {
        try {
            // Se uma nova senha for fornecida, faz o hash dela
            if ($senha_usuario !== null) {
                $senha_sha1 = sha1($senha_usuario);
            }

            // Query para atualizar os dados do usuário
            $query = "UPDATE usuarios 
                      SET nome_usuario = :nome_usuario, login_usuario = :login_usuario" .
                ($senha_usuario !== null ? ", senha_usuario = :senha_usuario" : "") .
                ", ativo_usuario = :ativo_usuario 
                      WHERE id_usuario = :id_usuario";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':nome_usuario', $nome_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':login_usuario', $login_usuario, PDO::PARAM_STR);
            if ($senha_usuario !== null) {
                $stmt->bindParam(':senha_usuario', $senha_sha1, PDO::PARAM_STR);
            }
            $stmt->bindParam(':ativo_usuario', $ativo_usuario, PDO::PARAM_BOOL);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar usuário: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirUsuario($id_usuario)
    {
        try {
            // Query para excluir o usuário
            $query = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
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
}
