<?php
require_once './php/view/tela_home.php';
require_once './php/controller/controllerLivro.php';
require_once './php/controller/controllerLivroGenero.php';
require_once './php/controller/controllerLivroAutor.php';
require_once './php/controller/controllerLocal.php';
require_once './php/controller/controller.php';
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
                <input class="form-control" type="text" name="titulo_livro" id="titulo_livro" placeholder="Titulo">
                <label for="test">Titulo</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Selecione um autor</option>
                    <?php
                    $usuarios = new Controller();
                    $usuarios->listarusuarios();
                    if ($usuarios) {
                        foreach ($usuarios as $usuario) {
                            echo '<option value="' . $usuario['id_usuario'] . '">' . htmlspecialchars($usuario['nome_usuario']) . '</option>';
                        }
                    }
                    ?>

                </select>
            </div>

        </form>
        <?php
    }
}