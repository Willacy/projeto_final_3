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
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

            <title>Biblioteca</title>
        </head>
        <?php
    }
    public function navbar()
    {
        ?>
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body mb-4" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/projeto_final_3">BIBLIOTECA FEDERAL</a>
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
                        <li><a class="nav-link" href="/projeto_final_3/usuario">Usuário</a></li>
                        <li><a class="nav-link" href="/projeto_final_3/livro">Livros</a></li>
                        <li><a class="nav-link" href="/projeto_final_3/movimentacao">Movimentação</a></li>
                        
      
                        <?php if ($_SESSION['validar']) { ?>
                            <form class="d-flex ms-auto" role="search">
                                <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logout">Sair</a>
                            </form>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="modal" tabindex="-1" id="logout">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/projeto_final_3/login" method="DELETE" class="form">
                        <div class="form-group my-3 text-center">
                            DESEJA SAIR?
                        </div>
                        <div class="my-3 text-center">
                            <button type="submit" class="btn btn-danger">CONFIRMAR</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                        </div>
                    </form>
                </div>
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

