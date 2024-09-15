<?php
require_once './controller.php';
class ControllerLivro extends Conexao
{
    // Função para pesquisar Livro sem ID
    public function pesquisarLivro($criterio)
    {
        try {
            $query = "SELECT * FROM livros WHERE titulo_livro LIKE :criterio";

            $stmt = $this->conexao->prepare($query);
            $criterio = '%' . $criterio . '%';
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);
            $stmt->execute();

            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            echo "Erro ao pesquisar Livro: " . $e->getMessage();
            return false;
        }
    }

    // Função para pesquisar Livro sem ID
    public function pesquisarLivroId($id_livro)
    {
        try {
            $query = "SELECT * FROM livros WHERE id_livro = :id_usuario";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':id_usuario', $id_livro, PDO::PARAM_INT);
            $stmt->execute();
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            echo "Erro ao pesquisar Livro: " . $e->getMessage();
            return false;
        }
    }

    // Atualizar dados do livro
    public function atualizarLivro()
    {

    }
}