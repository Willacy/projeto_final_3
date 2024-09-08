<?php
class Home
{
    public function cabecalho()
    {
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/projeto_final_3/css/bootstrap.min.css">
            <!--<link rel="stylesheet" href="./css/bootstrap.min.css">-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

            <title>Biblioteca</title>
        </head>
        <?php
    }
    public function navbar()
    {
        ?>
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body mb-4" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/projeto_final">BIBLIOTECA FEDERAL</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav w-100">
                        <!-- TUDO QUE ESTIVER DENTRO DESSE TAG <ul> aparecera no NAVBAR -->

                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/projeto_final_3/home">Ínicio</a>
                        </li>
                        <!-- MENU CADASTRO -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Cadastros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/projeto_final_3/usuario">Cadastro Usuário</a></li>
                                <li><a class="dropdown-item" href="/projeto_final_3/livro">Cadastro Livros</a></li>
                            </ul>
                        </li>

                        <!-- MENU PESQUISA -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Pesquisa
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/projeto_final_3/pesquisa">Usuário</a></li>
                                <li><a class="dropdown-item" href="#">Livro</a></li>
                            </ul>
                        </li>

                        <!-- MENU MOVIMENTO -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Movimentação
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Entrada livro</a></li>
                                <li><a class="dropdown-item" href="#">Venda livro</a></li>
                                <li><a class="dropdown-item" href="#">Emprestimo livro</a></li>
                            </ul>
                        </li>

                        <form class="d-flex ms-auto" role="search">
                            <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="$_SESSION.">Sair</a>
                        </form>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal fade" id="logout" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog bg-light p-4">
                <form action="" method="POST" class="form">
                    <div class="form-group my-3">
                        <label for="login_usuario">Login do Usuário</label>
                        <input type="text" name="login_usuario" id="login_usuario" class="form-control" required>
                    </div>
                    <div class="form-group my-3">
                        <label for="senha_usuario">Senha</label>
                        <input type="password" name="senha_usuario" id="senha_usuario" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
        <?php
    }
    public function home()
    {
        $this->cabecalho();
        $this->navbar();
        ?>
        <html>
        Bem vindo(a)!

        </html>
        <?php

    }
}

