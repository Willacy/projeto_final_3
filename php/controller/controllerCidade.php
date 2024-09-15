<?php
require_once './controller.php';
class ControllerCidade extends Conexao
{
    public function criarCidade()
    {
        try {
            // pega os dados da cidade
            $nome_cidade = $_POST['nome_cidade'];
            $fk_estado = $_POST['fk_estado'];

            // Query 
            $query = "INSERT INTO cidades (nome_cidade, fk_estado) VALUES (:nome_cidade, :fk_estado)";
            $stmt = $this->conexao->prepare($query);

            // bind dos parametros
            $stmt->bindParam(':nome_cidade', $nome_cidade, PDO::PARAM_STR);
            $stmt->bindParam(':fk_estado', $fk_estado, PDO::PARAM_INT);

            // Executa a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarCidade($criterio)
    {
        try {
            // Query
            $query = "SELECT * FROM cidades WHERE nome_cidade LIKE :criterio";
            $stmt = $this->conexao->prepare($query);

            // ajusta o critério para busca com wildcard
            $criterio = '%' . $criterio . '%';

            // bind dos parametros
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);

            // executa
            $stmt->execute();

            // retorna o resultado
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Cidade: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarCidadeId($id_cidade)
    {
        try {
            // Query
            $query = "SELECT * FROM cidades WHERE id_cidade = :id_cidade";
            $stmt = $this->conexao->prepare($query);

            // bind dos parametros
            $stmt->bindParam(':id_cidade', $id_cidade, PDO::PARAM_INT);

            // executa
            $stmt->execute();

            // retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Cidade: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarCidade($nome_cidade, $fk_estado, $id_cidade)
    {
        try {
            // Query
            $query = "UPDATE cidades SET nome_cidade = :nome_cidade, fk_estado = :fk_estado WHERE id_cidade = :id_cidade";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parametros
            $stmt->bindParam(':nome_cidade', $nome_cidade, PDO::PARAM_STR);
            $stmt->bindParam(':fk_estado', $fk_estado, PDO::PARAM_INT);
            $stmt->bindParam(':id_cidade', $id_cidade, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Cidade: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirCidade($id_cidade)
    {
        try {
            // Query
            $query = "DELETE FROM cidades WHERE id_cidade = :id_cidade";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parametros
            $stmt->bindParam(':id_cidade', $id_cidade, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Cidade: " . $e->getMessage();
            return false;
        }
    }
}
