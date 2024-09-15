<?php
require_once './php/controller/controller.php';
class ControllerLocal extends Conexao
{
    public function criarLocal()
    {
        try {
            // Pega os dados do local
            $sessao_local = $_POST['sessao_local'];
            $fileira_local = $_POST['fileira_local'];
            $num_fileira_local = $_POST['num_fileira_local'];

            // Query 
            $query = "INSERT INTO locais (sessao_local, fileira_local, num_fileira_local) VALUES (:sessao_local, :fileira_local, :num_fileira_local)";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':sessao_local', $sessao_local, PDO::PARAM_STR);
            $stmt->bindParam(':fileira_local', $fileira_local, PDO::PARAM_INT);
            $stmt->bindParam(':num_fileira_local', $num_fileira_local, PDO::PARAM_INT);

            // Executa a query
            $resultado = $stmt->execute();

            // Retorna o resultado
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarLocal($criterio)
    {
        try {
            // Query
            $query = "SELECT * FROM locais WHERE sessao_local LIKE :criterio OR fileira_local = :criterio";
            $stmt = $this->conexao->prepare($query);

            // Ajusta o critério para busca com
            $criterio = '%' . $criterio . '%';

            // Bind dos parâmetros
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);

            // Executa
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Local: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarLocalId($id_local)
    {
        try {
            // Query
            $query = "SELECT * FROM locais WHERE id_local = :id_local";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_local', $id_local, PDO::PARAM_INT);

            // Executa
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Local: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarLocal($sessao_local, $fileira_local, $num_fileira_local, $id_local)
    {
        try {
            // Query
            $query = "UPDATE locais SET sessao_local = :sessao_local, fileira_local = :fileira_local, num_fileira_local = :num_fileira_local WHERE id_local = :id_local";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':sessao_local', $sessao_local, PDO::PARAM_STR);
            $stmt->bindParam(':fileira_local', $fileira_local, PDO::PARAM_INT);
            $stmt->bindParam(':num_fileira_local', $num_fileira_local, PDO::PARAM_INT);
            $stmt->bindParam(':id_local', $id_local, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Local: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirLocal($id_local)
    {
        try {
            // Query
            $query = "DELETE FROM locais WHERE id_local = :id_local";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_local', $id_local, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Local: " . $e->getMessage();
            return false;
        }
    }
}
