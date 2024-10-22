<?php
session_start();
if (!$_SESSION['boracai']) :
    header("Location: ../index.php");
    die;
endif;

include '../conexao.php';

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="imagem/png" href="../img/boraçai.png" />
    <link rel="stylesheet" type="text/css" href="../css/css.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="../css/controle.css">
    <title>Controle de estoque</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand"> <img src="../img/boraçai.png" class="boracai" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <img src="../img/menu.png" class="navbar-toggler-icon" alt="Logo">
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="geral.php"><img src="../img/grafico.png" class="navbar-toggler-icon" alt="Logo"> Dashbord</a>
                    <a class="nav-link" href="venda/venda.php"><img src="../img/venda.png" class="navbar-toggler-icon" alt="Logo"> Registrar pedido</a>
                    <a class="nav-link" href="registros.php"><img src="../img/registros.png" class="navbar-toggler-icon" alt="Logo"> Histórico de pedidos</a>
                    <a class="nav-link" href="itens.php"><img src="../img/itens.png" class="navbar-toggler-icon" alt="Logo"> Produtos</a>
                    <a class="nav-link active" href="controle.php"><img src="../img/controle.png" class="navbar-toggler-icon" alt="Logo"> Controle de estoque</a>
                    <a class="nav-link" href="../login/sair.php"> <img src="../img/sair.png" class="navbar-toggler-icon" alt="Logo">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">

        <header>
            <h2>Controle de estoque</h2>
        </header>
        <div class="row">








        </div>
    </div>

</body>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>