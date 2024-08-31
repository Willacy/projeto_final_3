<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div>
        <?php
        require_once './src/nav_bar.php';
        ?>
    </div>


    <div>
        <h1>AULA SÁBADO 03.08.2024<br>----------------------</h1>
        <div>

            <h2>Apagar</h2>
            <form action="exemplo_clientes_delete.php" method="post">
                NOME: <input type="text" name="nome"> <br>
                <!-- E-MAIL: <input type="text" name="email"> <br>
                IDADE: <input type="text" name="idade"> <br>
                CIDADE: <input type="text" name="cidade"> <br>
                SALDO: <input type="text" name="saldo" id=""> <br>
                TELEFONE: <input type="text" name="telefone" id=""> <br> -->
                <input type="submit">
            </form>

        </div>

        <!-- <div>

            <h2>Pesquisa</h2>
            <form action="exemplo_clientes.php" method="post">
                IDADE: <input type="text" name="idade">
                NOME: <input type="text" name="nome">
                <input type="submit">
            </form>

        </div> -->

        <div>

            <h2>Resultado</h2>
            <?php
            require_once './src/db_connection_pdo.php';
            require_once './src/bootstrap_components.php';

            if (isset($_POST['nome'])) {
                $nome = $_POST['nome'];
            } else {
                $nome = '';
            }

            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $email = '';
            }

            if (isset($_POST['idade'])) {
                $idade = $_POST['idade'];
            } else {
                $idade = '';
            }

            if (isset($_POST['cidade'])) {
                $cidade = $_POST['cidade'];
            } else {
                $cidade = '';
            }

            if (isset($_POST['saldo'])) {
                $saldo = $_POST['saldo'];
            } else {
                $saldo = '';
            }

            if (isset($_POST['telefone'])) {
                $telefone = $_POST['telefone'];
            } else {
                $telefone = '';
            }

            if ($nome != '') {
                $consulta_sql = <<<HEREDOC
                    DELETE FROM clientes WHERE nome LIKE ?;
                HEREDOC;
                $matriz_tabela = array();
                $resultados = $conn->prepare($consulta_sql);
                $resultados->execute(array($nome));
            }


            $consulta_sql = <<<HEREDOC
                SELECT * FROM clientes;
            HEREDOC;
            $matriz_tabela = array();
            $resultados = $conn->prepare($consulta_sql);
            $resultados->execute(array());

            foreach ($resultados as $linha) {
                // echo $linha['nome'] . '<br>';
                // echo $linha['idade'] . '<br>';
                // echo $linha['cidade'] . '<br>' . '<br>';
                array_push($matriz_tabela, array(
                    $linha["nome"], $linha["email"], $linha["idade"], $linha["cidade"], $linha["saldo"], $linha["telefone"]
                ));
            }
            createTable(array("NOME", "EMAIL", "IDADE", "CIDADE", "SALDO", "TELEFONE"), $matriz_tabela);
            ?>
        </div>
    </div>
</body>

</html>