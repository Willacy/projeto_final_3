<?php
require_once "./php/view/tela_home.php";
class Livro extends Home
{
    public function postPesquisaLivro()
    {
        // navebar da pagina
        $this->cabecalho();
        $this->navbar();

        // Instancia O controller do livro e chama o metodo pesquisarLivro
        $controllerLivro = pass;

    }
}