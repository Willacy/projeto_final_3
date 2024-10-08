<?php
session_start();

require_once "./php/view/usuario.php";
require_once "./php/view/livro.php";
require_once "./php/view/movimentacao.php";
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
$livro = new Livro();
$movimentacao = new Movimentacao();
$home = new Home();

if ($method == "PUT") {
    parse_str(file_get_contents('php://input'), $_PUT);
}

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
/**
 * Login
 */
if ($method == "GET" and count($uri) == 1 and $uri[$inicio] == "login") {
    // Exibe formulário de Login
    $usuario->getLogin();
} else if ($method == "POST" and $uri[$inicio] == "login" and count($uri) == 1) {
    // Valida o login
    $usuario->postLogin();
} else if ($method == "DELETE" and $uri[$inicio] == "login" and count($uri) == 1) {
    // Valida o login
    $usuario->logout();
}
/**
 * home
 */ else if ($method == "GET" and count($uri) == 1 and $_SESSION["validar"] == true and $uri[$inicio] == "home") {
    // Se Login ok, vai para Home
    $home->home();
}
/**
 * Usuario
 */ else if ($method == "POST" and $uri[$inicio] == "usuario" and count($uri) == 1 and $_SESSION["validar"] == true) {
    // Cadastra usuario
    $usuario->post();
} else if ($method == "PUT" && $uri[$inicio] == "usuario" && count($uri) == 2 && $_SESSION["validar"] == true) {
    //atualiza usuario
    $usuario->put($uri[1]);
} else if ($method == "GET" && count($uri) == 2 && $_SESSION["validar"] == true && $uri[$inicio] == "usuario") {
    //pesquisa usuario por id
    $usuario->getUsuarioId($uri[1]);
} else if ($method == "DELETE" && $uri[$inicio] == "usuario" && count($uri) == 2 && $_SESSION["validar"] == true) {
    // Processa a exclusão do usuário
    $usuario->delete($uri[1]);
} else if ($method == "GET" and count($uri) == 1 and $_SESSION["validar"] == true and $uri[$inicio] == "usuario") {
    // Exibe a tela de pesquisa de usuário
    $usuario->getPesquisaUsuario();
} else if ($method == "POST" and $uri[$inicio] == "pesquisa" and count($uri) == 1 and $_SESSION["validar"] == true) {
    // Realiza a pesquisa de usuário
    $usuario->postPesquisaUsuario();
}else if ($method == "GET" && count($uri) == 3 && $_SESSION["validar"] == true && $uri[$inicio] == "usuario") {
    //pesquisa mov por id
    $movimentacao->getMovimentacaoUsuario($uri[2]);
    
}
/**
 * Livro
 */ else if ($method == "GET" and count($uri) == 1 and $_SESSION["validar"] == true and $uri[$inicio] == "livro") {
    // Exibe o formulário de cadastro de livros
    $livro->getCadastro();
} else if ($method == "POST" and $uri[$inicio] == "livro" and count($uri) == 1 and $_SESSION["validar"] == true) {
    // Processa o cadastro de um novo livro
    $livro->postCadastro();
} else if ($method == "GET" and count($uri) == 1 and $_SESSION["validar"] == true and $uri[$inicio] == "livro") {
    // Exibe a lista de livros cadastrados
    $livro->getLivros();
}


/**
 * Movimentação
 */ else if ($method == "GET" and count($uri) == 1 and $_SESSION["validar"] == true and $uri[$inicio] == "movimentacao") {
    // Exibe o formulário de cadastro de livros
    $movimentacao->getMovimentacao();
} else if ($method == "POST" and $uri[$inicio] == "movimentacao" and count($uri) == 1 and $_SESSION["validar"] == true) {
    // Processa o cadastro de um novo livro
    $movimentacao->postMovimentacao();
} 



/**
 * Rota Default
 */ else if ($_SESSION["validar"]) {
    header('Location: /projeto_final_3/home');
} else {
    header('Location: /projeto_final_3/login');
}
?>
<script>
    $('form[method=put],form[method=delete]').on('submit', (e) => {
        e.preventDefault();
        let action = $(e.target).attr('action');
        let metodo = $(e.target).attr('method');
        let data = $(e.target).serialize();
        $.ajax({
            url: action,
            method: metodo,
            data: data,
            context: document.body
        }).done((data) => {
            location.reload();
        });
    })
</script>
</body>

</html>