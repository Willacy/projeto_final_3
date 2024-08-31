<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Biblioteca</title>
</head>

<body>
    <?php
    require_once './src/nav_bar.php'
    ?>
    <h1>CADASTRO CLIENTE</h1>
    <form action="cadastro_cliente.php">
        <?php
        // importando configurações
        include_once '../src/bootstrap_components.php';
        // criando os inputs
        createInput("nome_cliente", "text", "NOME");
        createInput("endereco_cliente", "text", "ENDEREÇO");
        createInput("telefone_cliente", "text", "TELEFONE");
        createInput("email_cliente", "text", "E-MAIL");
        ?>
    </form>
</body>

</html>