<?php
require_once "./php/view/tela_home.php";
class Movimentacao extends Home
{
    public function getMovimentacao()
    {
        $this->cabecalho();
        $this->navbar();
    
        $controller = new ControllerUser();
    
        // Obter todos os usuários para seleção
        $usuarios = $controller->pesquisarUsuario('%');
    
        // Obter todos os livros para seleção
        $livros = $controller->pesquisarLivro('%');
    
        // Obter todos os tipos de movimentação
        $tiposMovimentacao = $controller->pesquisarTiposMovimentacao('%');
        ?>
    
        <div class="container">
            <div class="tudo">
                <div class="tela_movimentacao mx-auto bg-secondary-subtle p-3" style="width: 600px">
                    <form action="" method="POST" class="form">
                        <div class="form-group">
                            <label for="tipo_movimentacao">Tipo de Movimentação</label>
                            <select name="tipo_movimentacao" id="tipo_movimentacao" class="form-control" required>
                                <?php foreach ($tiposMovimentacao as $tipo): ?>
                                    <option value="<?= htmlspecialchars($tipo['id_tipo_mov']); ?>">
                                        <?= htmlspecialchars($tipo['descricao_mov']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="usuario">Usuário</label>
                            <select name="usuario" id="usuario" class="form-control" required>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?= htmlspecialchars($usuario['id_usuario']); ?>">
                                        <?= htmlspecialchars($usuario['nome_usuario']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="livro">Livro</label>
                            <select name="livro" id="livro" class="form-control" required>
                                <?php foreach ($livros as $livro): ?>
                                    <option value="<?= htmlspecialchars($livro['id_livro']); ?>">
                                        <?= htmlspecialchars($livro['titulo_livro']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
    
                        <button type="submit" class="btn btn-primary">Registrar Movimentação</button>
                    </form>
                </div>
            </div>
        </div>
    
        <?php
    }
    


    public function postMovimentacao()
    {
        // Tratamento do formulário de movimentação
        $tipo_movimentacao = $_POST['tipo_movimentacao'];
        $id_usuario = $_POST['usuario'];
        $id_livro = $_POST['livro'];

        $controller = new ControllerUser();
        $resultado = $controller->registrarMovimentacao($tipo_movimentacao, $id_usuario, $id_livro);

        if ($resultado) {
            echo '<div class="alert alert-success" role="alert">Movimentação registrada com sucesso!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao registrar a movimentação. Tente novamente.</div>';
        }
    }

    public function pesquisarTiposMovimentacao($criterio)
{
    try {
        $query = "SELECT * FROM tipos_mov WHERE descricao_mov LIKE :criterio";
        $stmt = $this->conexao->prepare($query);
        $criterio = '%' . $criterio . '%';
        $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;

    } catch (PDOException $e) {
        echo "Erro ao pesquisar tipos de movimentação: " . $e->getMessage();
        return false;
    }
}

}


?>
