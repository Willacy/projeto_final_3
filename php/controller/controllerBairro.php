<?php
require_once './controller.php';
class ControllerBairro extends Conexao
{
    public function criarBairro()
    {
        try {
            // Pega os dados do bairro
            $nome_bairro = $_POST['nome_bairro'];
            $fk_cidade = $_POST['fk_cidade'];

            // Query 
            $query = "INSERT INTO bairros (nome_bairro, fk_cidade) VALUES (:nome_bairro, :fk_cidade)";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':nome_bairro', $nome_bairro, PDO::PARAM_STR);
            $stmt->bindParam(':fk_cidade', $fk_cidade, PDO::PARAM_INT);

            // Executa a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarBairro($criterio)
    {
        try {
            // Query
            $query = "SELECT * FROM bairros WHERE nome_bairro LIKE :criterio";
            $stmt = $this->conexao->prepare($query);

            // Ajusta o critério para busca com wildcard
            $criterio = '%' . $criterio . '%';

            // Bind dos parâmetros
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);

            // Executa
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Bairro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarBairroId($id_bairro)
    {
        try {
            // Query
            $query = "SELECT * FROM bairros WHERE id_bairro = :id_bairro";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_bairro', $id_bairro, PDO::PARAM_INT);

            // Executa
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Bairro: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarBairro($nome_bairro, $fk_cidade, $id_bairro)
    {
        try {
            // Query
            $query = "UPDATE bairros SET nome_bairro = :nome_bairro, fk_cidade = :fk_cidade WHERE id_bairro = :id_bairro";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':nome_bairro', $nome_bairro, PDO::PARAM_STR);
            $stmt->bindParam(':fk_cidade', $fk_cidade, PDO::PARAM_INT);
            $stmt->bindParam(':id_bairro', $id_bairro, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Bairro: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirBairro($id_bairro)
    {
        try {
            // Query
            $query = "DELETE FROM bairros WHERE id_bairro = :id_bairro";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_bairro', $id_bairro, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Bairro: " . $e->getMessage();
            return false;
        }
    }
}
