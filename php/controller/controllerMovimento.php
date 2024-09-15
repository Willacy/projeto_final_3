<?php
require_once './controller.php';
class ControllerMovimento extends Conexao
{
    public function criarMovimento()
    {
        try {
            // Pega os dados do movimento
            $data_movimento = $_POST['data_movimento'];
            $quant_movimento = $_POST['quant_movimento'];
            $fk_usuario = $_POST['fk_usuario'];
            $fk_tipo = $_POST['fk_tipo'];

            // Query 
            $query = "INSERT INTO movimentos (data_movimento, quant_movimento, fk_usuario, fk_tipo) VALUES (:data_movimento, :quant_movimento, :fk_usuario, :fk_tipo)";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':data_movimento', $data_movimento, PDO::PARAM_STR);
            $stmt->bindParam(':quant_movimento', $quant_movimento, PDO::PARAM_STR);
            $stmt->bindParam(':fk_usuario', $fk_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':fk_tipo', $fk_tipo, PDO::PARAM_INT);

            // Executa a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarMovimento($criterio)
    {
        try {
            // Query
            $query = "SELECT * FROM movimentos WHERE data_movimento LIKE :criterio OR fk_usuario = :criterio";
            $stmt = $this->conexao->prepare($query);

            // Ajusta o critério para busca com wildcard para a data
            $criterio = '%' . $criterio . '%';

            // Bind dos parâmetros
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);

            // Executa
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Movimento: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarMovimentoId($id_movimento)
    {
        try {
            // Query
            $query = "SELECT * FROM movimentos WHERE id_movimento = :id_movimento";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_movimento', $id_movimento, PDO::PARAM_INT);

            // Executa
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Movimento: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarMovimento($data_movimento, $quant_movimento, $fk_usuario, $fk_tipo, $id_movimento)
    {
        try {
            // Query
            $query = "UPDATE movimentos SET data_movimento = :data_movimento, quant_movimento = :quant_movimento, fk_usuario = :fk_usuario, fk_tipo = :fk_tipo WHERE id_movimento = :id_movimento";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':data_movimento', $data_movimento, PDO::PARAM_STR);
            $stmt->bindParam(':quant_movimento', $quant_movimento, PDO::PARAM_STR);
            $stmt->bindParam(':fk_usuario', $fk_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':fk_tipo', $fk_tipo, PDO::PARAM_INT);
            $stmt->bindParam(':id_movimento', $id_movimento, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Movimento: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirMovimento($id_movimento)
    {
        try {
            // Query
            $query = "DELETE FROM movimentos WHERE id_movimento = :id_movimento";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_movimento', $id_movimento, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Movimento: " . $e->getMessage();
            return false;
        }
    }
}
