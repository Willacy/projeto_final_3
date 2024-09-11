<?php
require_once "./php/view/tela_home.php";
require_once "./php/controller/controller.php";
class Livro extends Home
{
    public function getCadastro()
    {
        $this->cabecalho();
        $this->navbar();
        ?>
        <div class="container">
            <h2>Cadastro de Livro</h2>
            <form action="/projeto_final_3/livro" method="POST">
                <div class="form-group my-3">
                    <label for="titulo_livro">Título do Livro</label>
                    <input type="text" name="titulo_livro" id="titulo_livro" class="form-control" required>
                </div>
                <div class="form-group my-3">
                    <label for="valor_venda_livro">Valor de Venda</label>
                    <input type="text" name="valor_venda_livro" id="valor_venda_livro" class="form-control" required>
                </div>
                <div class="form-group my-3">
                    <label for="valor_aluguel_livro">Valor de Aluguel</label>
                    <input type="text" name="valor_aluguel_livro" id="valor_aluguel_livro" class="form-control" required>
                </div>
                <div class="form-group my-3">
                    <label for="isbn_livro">ISBN</label>
                    <input type="text" name="isbn_livro" id="isbn_livro" class="form-control" required>
                </div>
                <div class="form-group my-3">
                    <label for="quantidade_livro">Quantidade de Livro</label>
                    <input type="text" name="quantidade_livro" id="quantidade_livro" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
        <?php
    }

    public function postCadastro()
    {
        $controller = new ControllerUser();
        $resultado = $controller->registrarLivro();
        if ($resultado) {
            echo '<div class="alert alert-success" role="alert">Livro cadastrado com sucesso!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar o livro. Tente novamente.</div>';
        }
    }

    public function getLivros()
    {
        require_once "./php/controller/controller.php";

        $sql = "SELECT * FROM livros";
        $result = Controller::getConexao()->query($sql);
        
        ?>
        <div class="container">
            <h2>Lista de Livros</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editora</th>
                        <th>Ano de Publicação</th>
                        <th>ISBN</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id_livro'] ?></td>
                        <td><?= $row['titulo_livro'] ?></td>
                        <td><?= $row['autor_livro'] ?></td>
                        <td><?= $row['valor_aluguel_livro'] ?></td>
                        <td><?= $row['ano_public_livro'] ?></td>
                        <td><?= $row['isbn_livro'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}
?>