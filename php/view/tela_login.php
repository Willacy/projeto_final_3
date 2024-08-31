<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Biblioteca - Login</title>
</head>

<body>
    <?php
    require_once __DIR__.'/../../src/nav_bar.php';
    require_once __DIR__.'/../controller/controller.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        // Iniciar conexão e controlador
        $conexao = new Conexao();
        $controller = new ControllerUser($conexao);

        // Validar login
        $usuario = $controller->validarLogin($login, $senha);

        if ($usuario) {
            echo '<div class="alert alert-success" role="alert">Login bem-sucedido!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Login ou senha inválidos.</div>';
        }
    }
    ?>


</body>

</html>
