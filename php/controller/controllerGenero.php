<?php
require_once './controller.php';
class ControllerGenero extends Conexao
{
    public function pesquisarGenero($criterio)
    {
        try {
            $query = "SELECT * FROM generos WHERE nome_genero LIKE :criterio";
            $stmt = $this->conexao->prepare($query);
            $criterio = '%' . $criterio . '%';
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);
            $stmt->execute();

            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            echo "Erro ao pesquisar Genero: " . $e->getMessage();
            return false;
        }

    }

    public function pesquisarGeneroId($id_genero)
    {
        try {
            $query = "SELECT * FROM generos WHERE id_genero = :id_genero";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':id_genero', $id_genero, PDO::PARAM_INT);
            $stmt->execute();
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            echo "Erro ao pesquisar Genero: " . $e->getMessage();
            return false;
        }
    }
    public function criarGenero()
    {

    }

    public function atualizarGenero($nome_genero, $id_genero)
    {
        try {
            // query que vai atualizar os Generos e prepara 
            $query = "UPDATE generos SET nome_genero = :nome_genero WHERE id_genero = :id_genero";
            $stmt = $this->conexao->prepare($query);

            // Bind dos parametros
            $stmt->bindParam(':nome_genero', $nome_genero, PDO::PARAM_STR);
            $stmt->bindParam(':id_genero', $id_genero, PDO::PARAM_STR);

            // Executa a query
            $stmt->execute();

            // verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;
        } catch (PDOException $e) {
            echo 'Erro ao atualizar Genero' . $e->getMessage();
        }
    }

    public function excluirGenero($id_genero)
    {
        try {
            $query = "DELETE FROM generos WHERE id_genero = :id_genero";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':id_genero', $id_genero, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Verifica se alguma linha foi afetada
            $resultado = $stmt->rowCount() > 0;
            return $resultado;

        } catch (PDOException $e) {
            echo "Erro ao excluir Genero: " . $e->getMessage();
            return false;
        }
    }
}