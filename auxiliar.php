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
}