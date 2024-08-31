<?php   
    class CadastroUsuario {
        public function home(){
            $home = new Home();
            $home->cabecalho ();
            $home->navbar ();
?>
            
<?php 
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../css/bootstrap.min.css">
    <link rel="stylesheet" href="./../../css/index.css">
    <title>Biblioteca - Cadastro Usuário</title>
</head>

<body>
    <?php
    require_once __DIR__.'/../../src/nav_bar.php';
    require_once __DIR__.'/../controller/controller.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome_usuario = $_POST['nome_usuario'];
        $login_usuario = $_POST['login_usuario'];
        $senha_usuario = sha1($_POST['senha_usuario']);

        // Iniciar conexão e controlador
        $conexao = new Conexao();
        

        
    }
    ?>

    <div class="container">
        <div class="tudo">
            <div class="tela_cadastro">
                <form action="cadastro_usuario.php" method="POST" class="form">
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

</body>

</html>
