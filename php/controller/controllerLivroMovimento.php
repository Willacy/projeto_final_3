<?php
require_once './controller.php';
class ControllerLivroMovimento extends Conexao
{
    public function criarLivroMovimento($fk_livro, $fk_movimento)
    {
        try {
            // Query
            $query = "INSERT INTO livros_movimentos (fk_livro, fk_movimento) 
                      VALUES (:fk_livro, :fk_movimento)";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':fk_livro', $fk_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_movimento', $fk_movimento, PDO::PARAM_INT);

            // Executa a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarLivroMovimento($fk_livro, $fk_movimento)
    {
        try {
            // Query
            $query = "SELECT * FROM livros_movimentos WHERE fk_livro = :fk_livro AND fk_movimento = :fk_movimento";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':fk_livro', $fk_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_movimento', $fk_movimento, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Livro-Movimento: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarLivroMovimento($id_livro_movimento, $fk_livro, $fk_movimento)
    {
        try {
            // Query
            $query = "UPDATE livros_movimentos 
                      SET fk_livro = :fk_livro, fk_movimento = :fk_movimento 
                      WHERE id_livro_movimento = :id_livro_movimento";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':fk_livro', $fk_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_movimento', $fk_movimento, PDO::PARAM_INT);
            $stmt->bindParam(':id_livro_movimento', $id_livro_movimento, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Livro-Movimento: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirLivroMovimento($id_livro_movimento)
    {
        try {
            // Query
            $query = "DELETE FROM livros_movimentos WHERE id_livro_movimento = :id_livro_movimento";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_livro_movimento', $id_livro_movimento, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Livro-Movimento: " . $e->getMessage();
            return false;
        }
    }
}
