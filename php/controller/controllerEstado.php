<?php
require_once './controller.php';
class ControllerEstado extends Conexao
{
    public function criarEstado()
    {
        try {
            // pega os dados do genero, no caso só o nome
            $nome_estado = $_POST['nome_estado'];
            $sigla_estado = $_POST['sigla_estado'];

            // Query 
            $query = "INSERT INTO estados (nome_estado, sigla_estado) VALUES (:nome_estado, :sigla_estado)";
            $stmt = $this->conexao->prepare($query);

            // bind dos parametros
            $stmt->bindParam(':nome_estado', $nome_estado, PDO::PARAM_STR);
            $stmt->bindParam(':sigla_estado', $sigla_estado, PDO::PARAM_STR);

            // Execulta a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarEstado($criterio)
    {
        try {
            // Query
            $query = "SELECT * FROM estados WHERE nome_estado LIKE :criterio";
            $stmt = $this->conexao->prepare($query);

            // coloca as pocentagens no criterio
            $criterio = '%' . $criterio . '%';

            // bind dos parametros
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);

            // execulta 
            $stmt->execute();

            //retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Estado: " . $e->getMessage();
            return false;
        }

    }

    public function pesquisarEstadoId($id_estado)
    {
        try {
            // Query
            $query = "SELECT * FROM estados WHERE id_estado = :id_estado";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parametros
            $stmt->bindParam(':id_estado', $id_estado, PDO::PARAM_INT);

            //  execulta
            $stmt->execute();

            // retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Estado: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarEstado($nome_estado, $sigla_estado, $id_estado)
    {
        try {
            // query
            $query = "UPDATE estados SET nome_estado = :nome_estado WHERE id_estado = :id_estado";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parametros
            $stmt->bindParam(':nome_estado', $nome_estado, PDO::PARAM_STR);
            $stmt->bindParam(':sigla_estado', $sigla_estado, PDO::PARAM_STR);
            $stmt->bindParam(':id_estado', $id_estado, PDO::PARAM_STR);

            // Executa a query
            $stmt->execute();

            // verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Estado' . $e->getMessage();
        }
    }

    public function excluirEstado($id_estado)
    {
        try {
            // Query
            $query = "DELETE FROM estados WHERE id_estado = :id_estado";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parametors
            $stmt->bindParam(':id_estado', $id_estado, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Estado: " . $e->getMessage();
            return false;
        }
    }
}