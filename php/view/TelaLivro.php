<?php
require_once './php/view/tela_home.php';
require_once './php/controller/controllerLivro.php';
require_once './php/controller/controllerLivroGenero.php';
require_once './php/controller/controllerLivroAutor.php';
require_once './php/controller/controllerLocal.php';
// Criando a classe
class TelaLivro extends Home
{
    public function menuLivro($metodo)
    {
        $this->cabecalho();
        $this->navbar();
        ?>
        <form action="" method=<?php $metodo ?> class="form">
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="test" id="" placeholder="Criterio">
                <label for="test">Criterio</label>
            </div>
        </form>
        <?php
    }
}