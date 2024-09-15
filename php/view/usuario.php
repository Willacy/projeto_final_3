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
    public function logout()
    {
        $controller = new ControllerUser();
        $controller->logout();
        echo '<div class="alert alert-success" role="alert">Logout Efetuado!</div>';
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
                        <div class="form-floating mb-3">
                            <input type="text" name="nome_usuario" id="nome_usuario" class="form-control"
                                placeholder="Nome de Usuário" required>
                            <label for="nome_usuario">Nome do cadas</label>
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
            $_SESSION['mensagem'] = 'Usuário cadastrado com sucesso!';
            //echo '<div class="alert alert-success" role="alert">Usuário cadastrado com sucesso!</div>';
            header('Location: /projeto_final_3/usuario');
        } else {
            $_SESSION['mensagem'] = 'Erro ao cadastrar o usuário. Tente novamente.';
            //echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar o usuário. Tente novamente.</div>';
            header('Location: /projeto_final_3/usuario');
        }
    }

    public function postPesquisaUsuario()
    {
        $this->cabecalho();
        $this->navbar();
        // Instancia o ControllerUser e chama o método pesquisarUsuario
        $controllerUser = new ControllerUser();
        if (isset($_GET['criterio'])) {
            $resultados = $controllerUser->pesquisarUsuario($_GET['criterio']);
        } else {
            $resultados = $controllerUser->pesquisarUsuario('%');
        }

        ?>

        <h1>Pesquisa de Usuário</h1>

        <form method="GET" action="">
            <label for="criterio">Pesquisar por Nome ou Login:</label>
            <input type="text" id="criterio" name="criterio" required>
            <button type="submit">Pesquisar</button>
        </form>

        <div class="form-group">
            <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cadastro">Novo</a>
        </div>

        <!-- modal tela cadastro -->
        <div class="modal" tabindex="-1" id="cadastro">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/projeto_final_3/usuario" method="POST" class="form">
                        <!-- <div class="container"> -->
                        <!-- <div class="tudo"> -->
                        <div class="tela_cadastro mx-auto bg-secondary-subtle p-3" style="width: 600px">
                            <!-- <form action="" method="POST" class="form"> -->
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
                            <!-- </form> -->
                        </div>
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="form-group my-3 text-center">
                            DESEJA SAIR?
                        </div>
                        <div class="my-3 text-center">
                            <button type="submit" class="btn btn-danger">CONFIRMAR</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>

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
                                <td class="form-group">
                                    <!-- Botão de Editar -->
                                    <form method="get" action="/projeto_final_3/usuario/<?= urlencode($usuario['id_usuario']); ?>">
                                        <input type="submit" value="Editar">
                                    </form>


                                    <!-- Botão de Excluir -->
                                    <form method="delete" action="/projeto_final_3/usuario/<?= urlencode($usuario['id_usuario']); ?>">
                                        <input type="submit" value="Excluir">
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

    public function getUsuarioId($id)
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



    public function delete($id)
    {
        $this->cabecalho();
        $this->navbar();
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

                <?php
                // Atualiza os dados do usuário no banco de dados.
                if (isset($id)) {
                    $resultado = $controllerUser->excluirUsuario($id);
                    echo $resultado;
                    if ($resultado) {
                        // Redireciona para a página de listagem de usuários com uma mensagem de sucesso.
                        $_SESSION['mensagem'] = "Usuário atualizado com sucesso.";

                        exit();
                    } else {
                        // Exibe mensagem de erro se a atualização falhar.
                        echo "<p>Erro ao excluir o usuário. Tente novamente.</p>";

                    }
                }
            } else {
                echo "<p>Usuário não encontrado.</p>";
            }
        } else {
            echo "<p>ID do usuário não fornecido.</p>";
        }
    }

    public function put($id)
    {
        $controllerUser = new controllerUser();

        parse_str(file_get_contents('php://input'), $_PUT);
        if (isset($id)) {
            $resultado = $controllerUser->atualizarUsuario($id, $_PUT['nome_usuario'], $_PUT['login_usuario'], sha1($_PUT['senha_usuario']));
            if ($resultado) {
                $_SESSION['mensagem'] = "Usuário atualizado com sucesso.";
                exit();
            }
        }
    }
}
?>