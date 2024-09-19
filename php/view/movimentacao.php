<?php
require_once "./php/view/tela_home.php";
class Movimentacao extends Home
{
    public function getMovimentacao()
    {
        $this->cabecalho();
        $this->navbar();
    
        $controller = new ControllerUser();
        $usuarios = $controller->pesquisarUsuario('%');
        $livros = $controller->pesquisarLivro('%');
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
                                        <?= htmlspecialchars($tipo['nome_tipo_mov']); ?> 
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

                        <div class="form-group">
                            <label for="data" class="label">Data:</label>
                            <input type="date" name="data" id="data" class="form-control" autocomplete="new-password" required>
                        </div>

                        <div class="form-group">
                            <label for="qtd" class="label">Quantidade:</label>
                            <input type="number" name="qtd" id="qtd" class="form-control" autocomplete="new-password" required>
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
        //$tipo_movimentacao = $_POST['tipo_movimentacao'];
        //$id_usuario = $_POST['usuario'];
        //$id_livro = $_POST['livro'];

        $controller = new ControllerUser();
        $resultado = $controller->registrarMovimentacao();

        if ($resultado) {
            echo '<div class="alert alert-success" role="alert">Movimentação registrada com sucesso!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao registrar a movimentação. Tente novamente.</div>';
        }
    }

    public function getMovimentacaoUsuario($id)
    {
        $this->cabecalho();
        $this->navbar();
        ?>

        </html>
        <?php
        // Verifica se o ID do usuário foi passado pela URL.
        if (isset($id)) {
            $id_usuario = htmlspecialchars($id);

            // Instancia o controlador do usuário.
            $controllerUser = new ControllerUser();

            // Recupera os dados do usuário usando o ID.
            $usuario = $controllerUser->buscarUsuarioPorId($id_usuario);

            if ($usuario) {
                // Exibe o formulário de edição com os dados do usuário.

                ?>
                <h2>Editar Usuário</h2>

                <form action="/projeto_final_3/usuario/<?= $id ?>" method="put">
                    <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']); ?>">

                    <div>
                        <label for="nome_usuario">Nome:</label>
                        <input type="text" id="nome_usuario" name="nome_usuario"
                            value="<?= htmlspecialchars($usuario['nome_usuario']); ?>" required>
                    </div>

                    <div>
                        <label for="login_usuario">Login:</label>
                        <input type="text" id="login_usuario" name="login_usuario"
                            value="<?= htmlspecialchars($usuario['login_usuario']); ?>" required>
                    </div>

                    <div>
                        <label for="senha_usuario">Senha:</label>
                        <input type="password" id="senha_usuario" name="senha_usuario"
                            value="<?= htmlspecialchars($usuario['senha_usuario']); ?>" required>
                    </div>

                    <button type="submit">Salvar Alterações</button>
                </form>
                <?php
                // Atualiza os dados do usuário no banco de dados.

            } else {
                echo "<p>Usuário não encontrado.</p>";
            }
        } else {
            echo "<p>ID do usuário não fornecido.</p>";
        }
    }


}


?>
