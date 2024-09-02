<?php

class Usuario {
    
    // Exibe o formulário de edição de usuário
    public function getEditarUsuario() {
        if (isset($_GET['id'])) {
            $id_usuario = $_GET['id'];
            
            require_once "./php/controller/controller.php";
            $controllerUser = new ControllerUser();
            $usuario = $controllerUser->buscarUsuarioPorId($id_usuario);

            if ($usuario) {
                include "./php/view/editar_usuario.php"; // View do formulário de edição
            } else {
                echo "<p>Usuário não encontrado.</p>";
            }
        } else {
            echo "<p>ID do usuário não fornecido.</p>";
        }
    }

    // Processa a edição do usuário
    public function postEditarUsuario() {
        if (isset($_POST['id_usuario'])) {
            $id_usuario = $_POST['id_usuario'];
            $nome_usuario = $_POST['nome_usuario'];
            $login_usuario = $_POST['login_usuario'];

            require_once "./php/controller/controller.php";
            $controllerUser = new ControllerUser();
            $resultado = $controllerUser->atualizarUsuario($id_usuario, $nome_usuario, $login_usuario);

            if ($resultado) {
                $_SESSION['mensagem'] = "Usuário atualizado com sucesso.";
                header('Location: /projeto_final_3/pesquisa');
                exit();
            } else {
                echo "<p>Erro ao atualizar o usuário.</p>";
            }
        } else {
            echo "<p>ID do usuário não fornecido.</p>";
        }
    }

    // Outros métodos existentes...
}

public function postEditarUsuario()
    {
        // ?>
        // <?php if (isset($usuario)): ?>
        //     <h2>Editar Usuário</h2>
        //     <form action="/projeto_final_3/editar_usuario" method="post">
        //         <input type="number" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']); ?>">

        //         <div>
        //             <label for="nome_usuario">Nome:</label>
        //             <input type="text" id="nome_usuario" name="nome_usuario"
        //                 value="<?= htmlspecialchars($usuario['nome_usuario']); ?>" required>
        //         </div>

        //         <div>
        //             <label for="login_usuario">Login:</label>
        //             <input type="text" id="login_usuario" name="login_usuario"
        //                 value="<?= htmlspecialchars($usuario['login_usuario']); ?>" required>
        //         </div>

        //         <button type="submit">Salvar Alterações</button>
        //     </form>
        // <?php else: ?>
        //     <p>Usuário não encontrado.</p>
        //     <?php
        // endif;


        // if (isset($_POST['id_usuario'])) {
        //     $id_usuario = $_POST['id_usuario'];
        //     $nome_usuario = $_POST['nome_usuario'];
        //     $login_usuario = $_POST['login_usuario'];

        //     require_once "./php/controller/controller.php";
        //     $controllerUser = new ControllerUser();
        //     $resultado = $controllerUser->atualizarUsuario($id_usuario, $nome_usuario, $login_usuario);

        //     if ($resultado) {
        //         $_SESSION['mensagem'] = "Usuário atualizado com sucesso.";
        //         header('Location: /projeto_final_3/pesquisa');
        //         exit();
        //     } else {
        //         echo "<p>Erro ao atualizar o usuário.</p>";
        //     }
        // } else {
        //     echo "<p>ID do usuário não fornecido.</p>";
        // }
    }
?>
