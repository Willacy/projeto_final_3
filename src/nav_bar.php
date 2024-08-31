<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body mb-4" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/projeto_final">BIBLIOTECA FEDERAL DAS PUTAS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <!-- TUDO QUE ESTIVER DENTRO DESSE TAG <ul> aparecera no NAVBAR -->

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/projeto_final">Ínicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/projeto_final/Cadastro.php">Cadastro</a>
                </li>

                        <?php
                        foreach (scandir(__DIR__ . "/../projetos") as $projeto) {
                            if (preg_match("/" . "\.php$" . "/Xu", $projeto)) {
                                $nome_projeto = strtoupper(preg_replace("/" . "\.php$" . "/Xu", "", $projeto));
                                echo <<<HEREDOC
                                <li><a class="dropdown-item" href="/tutorial_php/projetos/$projeto">$nome_projeto</a></li>
                                HEREDOC;
                            }
                        }
                        ?>
                    </ul>
                </li> 


            </ul>
        </div>
    </div>
</nav>