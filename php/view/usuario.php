<?php
require_once "./php/view/tela_home.php";
class Usuario extends Home
{
    // tela de login
    public function getLogin()
    {
        $this->cabecalho();
        $this->navbar();

        ?>
        <div class="container">
            <div class="tudo">
                <div class="tela_login mx-auto bg-secondary-subtle p-3" style="width: 400px">
                    <form action="" method="POST" class="form">
                        <div class="form-group">
                            <label for="login" class="label">LOGIN:</label>
                            <input type="text" name="login" id="login" class="form-control" autocomplete="new-password"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="senha" class="label">SENHA:</label>
                            <input type="password" name="senha" id="senha" class="form-control mb-2" autocomplete="new-password"
                                required>
                        </div>
                        <!-- <input type="submit" class="botao" value="Entrar"> -->
                        <button type="submit" class="btn btn-primary">ENTRAR</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
    public function logout($conn)
    {
        $this->$conn = null;
    }
    public function postLogin()
    {
        $controller = new ControllerUser();
        $resultado = $controller->validarLogin();
        if ($resultado) {
            echo '<div class="alert alert-success" role="alert">Login bem-sucedido!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Login ou senha inválidos.</div>';
        }
    }
    public function getCadastro()
    {
        $this->cabecalho();
        $this->navbar();
        ?>
        <div class="container">
            <div class="tudo">
                <div class="tela_cadastro mx-auto bg-secondary-subtle p-3" style="width: 600px">
                    <form action="" method="POST" class="form">
                        <div class="form-group">
                            <label for="nome_usuario">Nome do Usuário</label>
                            <input type="text" name="nome_usuario" id="nome_usuario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="login_usuario">Login do Usuário</label>
                            <input type="text" name="login_usuario" id="login_usuario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="senha_usuario">Senha</label>
                            <input type="password" name="senha_usuario" id="senha_usuario" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php

    }
    public function post()
    {
        $controller = new ControllerUser();
        $resultado = $controller->registrarUsusario();
        if ($resultado) {
            echo '<div class="alert alert-success" role="alert">Usuário cadastrado com sucesso!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar o usuário. Tente novamente.</div>';
        }
    }

    public function postPesquisaUsuario()
    {
        $this->cabecalho();
        $this->navbar();
        // Instancia o ControllerUser e chama o método pesquisarUsuario
        $controllerUser = new ControllerUser();
        if (isset($_POST['criterio'])) {
            $resultados = $controllerUser->pesquisarUsuario($_POST['criterio']);
        } else {
            $resultados = $controllerUser->pesquisarUsuario(' ');
        }

        ?>

        <h1>Pesquisa de Usuário</h1>

        <form method="post" action="">
            <label for="criterio">Pesquisar por Nome ou Login:</label>
            <input type="text" id="criterio" name="criterio" required>
            <button type="submit">Pesquisar</button>
        </form>

        <?php if (isset($resultados)): ?>
            <?php if ($resultados): ?>
                <h2>Resultados da Pesquisa:</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Ações</th> <!-- Nova coluna para as ações -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['id_usuario']); ?></td>
                                <td><?= htmlspecialchars($usuario['nome_usuario']); ?></td>
                                <td><?= htmlspecialchars($usuario['login_usuario']); ?></td>
                                <td>
                                    <!-- Botão de Editar -->
                                    <a href="/projeto_final_3/editar_usuario?id=<?= urlencode($usuario['id_usuario']); ?>">Editar</a>

                                    <!-- Botão de Excluir -->
                                    <form action="/projeto_final_3/excluir_usuario" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id_usuario']); ?>">
                                        <button type="submit"
                                            onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Nenhum usuário encontrado com o critério especificado.</p>
            <?php endif; ?>
        <?php endif; ?>
        </body>

        </html>


        <?php

    }
    public function getPesquisaUsuario()
    {
        $this->postPesquisaUsuario();
    }

    public function put()
    {
        $this->postEditarUsuario();
    }

    public function postEditarUsuario()
    {
        $this->cabecalho();
        $this->navbar();
        // Verifica se o ID do usuário foi passado pela URL.
        if (isset($_GET['id'])) {
            $id_usuario = htmlspecialchars($_GET['id']);

            // Instancia o controlador do usuário.
            $controllerUser = new ControllerUser();

            // Recupera os dados do usuário usando o ID.
            $usuario = $controllerUser->buscarUsuarioPorId($id_usuario);

            if ($usuario) {
                // Exibe o formulário de edição com os dados do usuário.
                ?>
                <h2>Editar Usuário</h2>
                <form action="" method="post">
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
                if (isset($_POST['id_usuario'])) {
                    $resultado = $controllerUser->atualizarUsuario($_POST['id_usuario'], $_POST['nome_usuario'], $_POST['login_usuario'], sha1($_POST['senha_usuario']));
                    if ($resultado) {
                        // Redireciona para a página de listagem de usuários com uma mensagem de sucesso.
                        $_SESSION['mensagem'] = "Usuário atualizado com sucesso.";
                        echo '<script type="text/javascript">
                         window.location.href = "/projeto_final_3/pesquisa";
                         </script>';

                        exit();
                    } else {
                        // Exibe mensagem de erro se a atualização falhar.
                        echo "<p>Erro ao atualizar o usuário. Tente novamente.</p>";
                    }
                }
            } else {
                echo "<p>Usuário não encontrado.</p>";
            }
        } else {
            echo "<p>ID do usuário não fornecido.</p>";
        }
    }

    public function delete()
    {
    }
}
?>