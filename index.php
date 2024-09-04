<?php
session_start();

require_once "./php/view/usuario.php";
require_once "./php/view/tela_home.php";
require_once "./php/controller/controller.php";

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$uri = explode("?", $uri)[0];
$uri = preg_replace('/\/{2,}/', '/', $uri);
$uri = explode("/", $uri);
$uri = array_splice($uri, 2);
$tamanho = count($uri);
if ($uri[$tamanho - 1] == "")
    array_pop($uri);
$inicio = 0;

$usuario = new Usuario();
$home = new Home();

if (isset($_SESSION['mensagem'])) {
    echo "
            <div class='toast show position-fixed bottom-0 end-0 align-items-center text-bg-info border-0 text-white'  role='alert' aria-live='assertive' aria-atomic='true'>
            <div class='d-flex'>
                <div class='toast-body'>
                {$_SESSION['mensagem']}
                </div>
                <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
            </div>";
}

unset($_SESSION['mensagem']);

if ($method == "GET" and $uri[$inicio] == "login" and count($uri) == 1) {
    // Exibe formulário de Login
    $usuario->getLogin();
} else if ($method == "POST" and $uri[$inicio] == "login" and count($uri) == 1) {
    // Valida o login
    $usuario->postLogin();
} else if ($method == "GET" and $uri[$inicio] == "home" and count($uri) == 1 and $_SESSION["validar"] == true) {
    // Se Login ok, vai para Home
    $home->home();
} else if ($method == "POST" and $uri[$inicio] == "usuario" and count($uri) == 1 and $_SESSION["validar"] == true) {
    // Realiza ação específica para POST na rota /usuario
    $usuario->post();
} else if ($method == "GET" and $uri[$inicio] == "usuario" and count($uri) == 1 and $_SESSION["validar"] == true) {
    // Exibe formulário de cadastro de usuário
    $usuario->getCadastro();
} else if ($method == "GET" and $uri[$inicio] == "pesquisa" and count($uri) == 1 and $_SESSION["validar"] == true) {
    // Exibe a tela de pesquisa de usuário
    $usuario->getPesquisaUsuario('willian');
} else if ($method == "POST" and $uri[$inicio] == "pesquisa" and count($uri) == 1 and $_SESSION["validar"] == true) {
    // Realiza a pesquisa de usuário
    $usuario->postPesquisaUsuario();
} else if ($method == "GET" && $uri[$inicio] == "editar_usuario" && count($uri) == 1 && $_SESSION["validar"] == true) {
    // Exibe o formulário de edição de usuário
    $usuario->put();
} else if ($method == "POST" && $uri[$inicio] == "editar_usuario" && count($uri) == 1 && $_SESSION["validar"] == true) {
    // Processa a edição do usuário
    $usuario->postEditarUsuario();
} else if ($method == "GET" && $uri[$inicio] == "excluir_usuario" && count($uri) == 1 && $_SESSION["validar"] == true) {
    // Processa a exclusão do usuário
    $usuario->delete();
} else if ($method == "POST" && $uri[$inicio] == "excluir_usuario" && count($uri) == 1 && $_SESSION["validar"] == true) {
    // Processa a edição do usuário
    $usuario->postExcluirUsuario();
} else {
    // Redireciona para a tela de login
    header('Location: /projeto_final_3/login');
}
?>