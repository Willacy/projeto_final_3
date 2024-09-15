<?php
require_once './controller.php';
class ControllerTipoMov extends Conexao
{
    public function criarTipoMov()
    {
        try {
            // Pega os dados do tipo de movimento
            $nome_tipo_mov = $_POST['nome_tipo_mov'];

            // Query 
            $query = "INSERT INTO tipos_mov (nome_tipo_mov) VALUES (:nome_tipo_mov)";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':nome_tipo_mov', $nome_tipo_mov, PDO::PARAM_STR);

            // Executa a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarTipoMov($criterio)
    {
        try {
            // Query
            $query = "SELECT * FROM tipos_mov WHERE nome_tipo_mov LIKE :criterio";
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
            echo "Erro ao pesquisar Tipo de Movimento: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarTipoMovId($id_tipo_mov)
    {
        try {
            // Query
            $query = "SELECT * FROM tipos_mov WHERE id_tipo_mov = :id_tipo_mov";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_tipo_mov', $id_tipo_mov, PDO::PARAM_INT);

            // Executa
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Tipo de Movimento: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarTipoMov($nome_tipo_mov, $id_tipo_mov)
    {
        try {
            // Query
            $query = "UPDATE tipos_mov SET nome_tipo_mov = :nome_tipo_mov WHERE id_tipo_mov = :id_tipo_mov";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':nome_tipo_mov', $nome_tipo_mov, PDO::PARAM_STR);
            $stmt->bindParam(':id_tipo_mov', $id_tipo_mov, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Tipo de Movimento: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirTipoMov($id_tipo_mov)
    {
        try {
            // Query
            $query = "DELETE FROM tipos_mov WHERE id_tipo_mov = :id_tipo_mov";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_tipo_mov', $id_tipo_mov, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Tipo de Movimento: " . $e->getMessage();
            return false;
        }
    }
}
