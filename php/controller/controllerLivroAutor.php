<?php
require_once './controller.php';
class ControllerLivroAutor extends Conexao
{
    public function criarLivroAutor($fk_livro, $fk_autor)
    {
        try {
            // Query
            $query = "INSERT INTO livros_autores (fk_livro, fk_autor) 
                      VALUES (:fk_livro, :fk_autor)";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':fk_livro', $fk_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_autor', $fk_autor, PDO::PARAM_INT);

            // Executa a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarLivroAutor($fk_livro, $fk_autor)
    {
        try {
            // Query
            $query = "SELECT * FROM livros_autores WHERE fk_livro = :fk_livro AND fk_autor = :fk_autor";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':fk_livro', $fk_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_autor', $fk_autor, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Livro-Autor: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarLivroAutor($id_livro_autor, $fk_livro, $fk_autor)
    {
        try {
            // Query
            $query = "UPDATE livros_autores 
                      SET fk_livro = :fk_livro, fk_autor = :fk_autor 
                      WHERE id_livro_autor = :id_livro_autor";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':fk_livro', $fk_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_autor', $fk_autor, PDO::PARAM_INT);
            $stmt->bindParam(':id_livro_autor', $id_livro_autor, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Livro-Autor: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirLivroAutor($id_livro_autor)
    {
        try {
            // Query
            $query = "DELETE FROM livros_autores WHERE id_livro_autor = :id_livro_autor";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_livro_autor', $id_livro_autor, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Livro-Autor: " . $e->getMessage();
            return false;
        }
    }
}
