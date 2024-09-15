<?php
require_once './php/controller/controller.php';
class ControllerLivroGenero extends Conexao
{
    public function criarLivroGenero($fk_livro, $fk_genero)
    {
        try {
            // Query
            $query = "INSERT INTO livros_generos (fk_livro, fk_genero) 
                      VALUES (:fk_livro, :fk_genero)";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':fk_livro', $fk_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_genero', $fk_genero, PDO::PARAM_INT);

            // Executa a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarLivroGenero($fk_livro, $fk_genero)
    {
        try {
            // Query
            $query = "SELECT * FROM livros_generos WHERE fk_livro = :fk_livro AND fk_genero = :fk_genero";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':fk_livro', $fk_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_genero', $fk_genero, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Livro-Gênero: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarLivroGenero($id_livro_genero, $fk_livro, $fk_genero)
    {
        try {
            // Query
            $query = "UPDATE livros_generos 
                      SET fk_livro = :fk_livro, fk_genero = :fk_genero 
                      WHERE id_livro_genero = :id_livro_genero";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':fk_livro', $fk_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_genero', $fk_genero, PDO::PARAM_INT);
            $stmt->bindParam(':id_livro_genero', $id_livro_genero, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Livro-Gênero: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirLivroGenero($id_livro_genero)
    {
        try {
            // Query
            $query = "DELETE FROM livros_generos WHERE id_livro_genero = :id_livro_genero";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_livro_genero', $id_livro_genero, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Livro-Gênero: " . $e->getMessage();
            return false;
        }
    }
}
