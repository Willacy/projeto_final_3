<?php
require_once './controller.php';
class ControllerEndereco extends Conexao
{
    public function criarEndereco()
    {
        try {
            // Pega os dados do endereço
            $rua_endereco = $_POST['rua_endereco'];
            $cep = $_POST['cep'];
            $fk_usuario = $_POST['fk_usuario'];
            $fk_bairro = $_POST['fk_bairro'];
            $fk_movimento = $_POST['fk_movimento'];

            // Query 
            $query = "INSERT INTO endereco (rua_endereco, cep, fk_usuario, fk_bairro, fk_movimento) VALUES (:rua_endereco, :cep, :fk_usuario, :fk_bairro, :fk_movimento)";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':rua_endereco', $rua_endereco, PDO::PARAM_STR);
            $stmt->bindParam(':cep', $cep, PDO::PARAM_STR);
            $stmt->bindParam(':fk_usuario', $fk_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':fk_bairro', $fk_bairro, PDO::PARAM_INT);
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

    public function pesquisarEndereco($criterio)
    {
        try {
            // Query
            $query = "SELECT * FROM endereco WHERE rua_endereco LIKE :criterio OR cep LIKE :criterio";
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
            echo "Erro ao pesquisar Endereço: " . $e->getMessage();
            return false;
        }
    }

    public function pesquisarEnderecoId($id_endereco)
    {
        try {
            // Query
            $query = "SELECT * FROM endereco WHERE id_endereco = :id_endereco";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT);

            // Executa
            $stmt->execute();

            // Retorna o resultado
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Erro ao pesquisar Endereço: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarEndereco($rua_endereco, $cep, $fk_usuario, $fk_bairro, $fk_movimento, $id_endereco)
    {
        try {
            // Query
            $query = "UPDATE endereco SET rua_endereco = :rua_endereco, cep = :cep, fk_usuario = :fk_usuario, fk_bairro = :fk_bairro, fk_movimento = :fk_movimento WHERE id_endereco = :id_endereco";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':rua_endereco', $rua_endereco, PDO::PARAM_STR);
            $stmt->bindParam(':cep', $cep, PDO::PARAM_STR);
            $stmt->bindParam(':fk_usuario', $fk_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':fk_bairro', $fk_bairro, PDO::PARAM_INT);
            $stmt->bindParam(':fk_movimento', $fk_movimento, PDO::PARAM_INT);
            $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo 'Erro ao atualizar Endereço: ' . $e->getMessage();
            return false;
        }
    }

    public function excluirEndereco($id_endereco)
    {
        try {
            // Query
            $query = "DELETE FROM endereco WHERE id_endereco = :id_endereco";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Endereço: " . $e->getMessage();
            return false;
        }
    }
}
