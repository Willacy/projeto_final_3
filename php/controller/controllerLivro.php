<?php
require_once './controller.php';
class ControllerLivro extends Conexao
{
    public function criarLivro()
    {
        try {
            // Pega os dados do livro
            $titulo_livro = $_POST['titulo_livro'];
            $valor_venda_livro = $_POST['valor_venda_livro'];
            $valor_aluguel_livro = $_POST['valor_aluguel_livro'];
            $isbn_livro = $_POST['isbn_livro'];
            $ativo_livro = isset($_POST['ativo_livro']) ? $_POST['ativo_livro'] : 1; // Ativo por padrão
            $quantidade_livro = $_POST['quantidade_livro'];
            $fk_local = $_POST['fk_local'];

            // Query 
            $query = "INSERT INTO livros (titulo_livro, valor_venda_livro, valor_aluguel_livro, isbn_livro, ativo_livro, quantidade_livro, fk_local) 
                      VALUES (:titulo_livro, :valor_venda_livro, :valor_aluguel_livro, :isbn_livro, :ativo_livro, :quantidade_livro, :fk_local)";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':titulo_livro', $titulo_livro, PDO::PARAM_STR);
            $stmt->bindParam(':valor_venda_livro', $valor_venda_livro, PDO::PARAM_STR);
            $stmt->bindParam(':valor_aluguel_livro', $valor_aluguel_livro, PDO::PARAM_STR);
            $stmt->bindParam(':isbn_livro', $isbn_livro, PDO::PARAM_STR);
            $stmt->bindParam(':ativo_livro', $ativo_livro, PDO::PARAM_BOOL);
            $stmt->bindParam(':quantidade_livro', $quantidade_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_local', $fk_local, PDO::PARAM_INT);

            // Executa a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarLivro($criterio)
    {
        try {
            // Query
            $query = "SELECT * FROM livros WHERE titulo_livro LIKE :criterio OR isbn_livro LIKE :criterio";
            $stmt = $this->conexao->prepare($query);

            // Ajusta o critério para busca
            $criterio = '%' . $criterio . '%';

            // Bind dos parâmetros
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);

            // Executa
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Livro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarLivroId($id_livro)
    {
        try {
            // Query
            $query = "SELECT * FROM livros WHERE id_livro = :id_livro";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_livro', $id_livro, PDO::PARAM_INT);

            // Executa
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Livro: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarLivro($titulo_livro, $valor_venda_livro, $valor_aluguel_livro, $isbn_livro, $ativo_livro, $quantidade_livro, $fk_local, $id_livro)
    {
        try {
            // Query
            $query = "UPDATE livros 
                      SET titulo_livro = :titulo_livro, valor_venda_livro = :valor_venda_livro, valor_aluguel_livro = :valor_aluguel_livro, 
                          isbn_livro = :isbn_livro, ativo_livro = :ativo_livro, quantidade_livro = :quantidade_livro, fk_local = :fk_local 
                      WHERE id_livro = :id_livro";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':titulo_livro', $titulo_livro, PDO::PARAM_STR);
            $stmt->bindParam(':valor_venda_livro', $valor_venda_livro, PDO::PARAM_STR);
            $stmt->bindParam(':valor_aluguel_livro', $valor_aluguel_livro, PDO::PARAM_STR);
            $stmt->bindParam(':isbn_livro', $isbn_livro, PDO::PARAM_STR);
            $stmt->bindParam(':ativo_livro', $ativo_livro, PDO::PARAM_BOOL);
            $stmt->bindParam(':quantidade_livro', $quantidade_livro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_local', $fk_local, PDO::PARAM_INT);
            $stmt->bindParam(':id_livro', $id_livro, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Livro: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirLivro($id_livro)
    {
        try {
            // Query
            $query = "DELETE FROM livros WHERE id_livro = :id_livro";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_livro', $id_livro, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Livro: " . $e->getMessage();
            return false;
        }
    }
}
