<?php
include '../../conexao.php';
session_start();
if (!$_SESSION['boracai']) :
    header("Location: ../../index.php");
    die;
endif;

// Inicializa um array para armazenar os itens do carrinho
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
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
    <link rel="icon" type="imagem/png" href="../../img/boraçai.png" />
    <link rel="stylesheet" type="text/css" href="../../css/css.css">
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../css/venda.css">
    <title>Registrar pedido</title>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand"> <img src="../../img/boraçai.png" class="boracai" alt="Logo"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="navbar-nav">
                                <a class="nav-link" href="../geral.php"><i class="fas fa-chart-line"></i> Dashbord</a>
                                <a class="nav-link active" href="venda.php"><i class="fas fa-shopping-cart"></i> Registrar pedido</a>
                                <a class="nav-link" href="../registros.php"><i class="fas fa-history"></i> Histórico de pedidos</a>
                                <a class="nav-link" href="../itens.php"><i class="fas fa-box"></i> Produtos</a>
                                <a class="nav-link" href="../../login/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </nav>


            <header>
                <h2>Registrar pedido</h2>
            </header>
            <div class="div col-md3" style="text-align: center;">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal3">
                    <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                    Pedido
                </button>
            </div>
            <!-- Espaço inicial -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            </div>



            <div class="container col-lg-12">
                <form id="carrinhoForm" method="POST" action="add_carrinho.php">
                    <div class="row">

                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal1">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="align-self-center">
                                                    <img src="../../img/acai.png" alt="Logo" style="width: 40px;">
                                                </div>
                                                <div class="media-body text-right">
                                                    <h3 class="fs-2 fs-sm-5 fs-md-6">Adicionar copo de açaí</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            </br>
                        </div>


                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal2">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="align-self-center">
                                                    <img src="../../img/bolo.png" alt="Logo" style="width: 40px;">
                                                </div>
                                                <div class="media-body text-right">
                                                    <h3 class="fs-2 fs-sm-5 fs-md-6">Adicionar bolo de pote</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            </br>
                        </div>

                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal4">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="align-self-center">
                                                    <img src="../../img/torta.png" alt="Logo" style="width: 40px;">
                                                </div>
                                                <div class="media-body text-right">
                                                    <h3 class="fs-2 fs-sm-5 fs-md-6">Adicionar torta</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            </br>
                        </div>

                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal5">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="align-self-center">
                                                    <img src="../../img/alfajor.png" alt="Logo" style="width: 40px;">
                                                </div>
                                                <div class="media-body text-right">
                                                    <h3 class="fs-2 fs-sm-5 fs-md-6">Adicionar alfajor</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            </br>
                        </div>

                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal6">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="align-self-center">
                                                    <img src="../../img/brigadeiro.png" alt="Logo" style="width: 40px;">
                                                </div>
                                                <div class="media-body text-right">
                                                    <h3 class="fs-2 fs-sm-5 fs-md-6">Adicionar brigadeiro</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            </br>
                        </div>

                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal7">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="align-self-center">
                                                    <img src="../../img/outrosprodutos.png" alt="Logo" style="width: 40px;">
                                                </div>
                                                <div class="media-body text-right">
                                                    <h3 class="fs-2 fs-sm-5 fs-md-6">Adicionar outro produto</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            </br>
                        </div>

                    </div>
            </div>





            <!-- Modal 1 (Açaí) -->
            <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal1Label">Selecione o açaí</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span style="font-weight: bolder;">Tamanho:</span>
                            <select class="form-select" name="tamanho_acai" aria-label="Selecionar Tamanho">

                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor = 0 and i.id_itens = 1");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <option value="<?= $tamanho ?> - R$ <?= $valor ?>"><?= $tamanho ?> ml - R$ <?= $valor ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <span style="font-weight: bolder;">Adicionais:</span>
                            <div class="div col-lg-12">

                                <?php
                                $sth = $pdo->prepare("SELECT * FROM adicionais WHERE status_adicional = 0");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="adicionais[]" value="<?= $nome_adicional ?> - R$ <?= $valor_adicional ?>" id="adicional_<?= $id_adicional ?>">
                                        <label for="adicional_<?= $id_adicional ?>">
                                            <?= $nome_adicional ?> - R$ <?= $valor_adicional ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success" name="acao" value="adicionar_acai" onclick="adicionarAoCarrinho()">Adicionar ao pedido</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 2 (Bolo) -->
            <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal2Label">Selecione o bolo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span style="font-weight: bolder;">Sabores:</span>
                            <select class="form-select" name="sabor_bolo" aria-label="Selecionar Sabor do Bolo">
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN saborgeral s ON s.id_geral = p.sabor INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor > 0 and i.id_itens = 2 and statusgeral = 0");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <option value="<?= $nome_sabor ?> - R$ <?= $valor ?>"><?= $nome_sabor ?> - R$ <?= $valor ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success" name="acao" value="adicionar_bolo">Adicionar ao pedido</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 4 (torta) -->
            <div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="modal4Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal4Label">Selecione a torta</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span style="font-weight: bolder;">Sabores:</span>
                            <select class="form-select" name="torta" aria-label="Selecionar Sabor da Torta">
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN saborgeral s ON s.id_geral = p.sabor INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor > 0 and i.id_itens = 3 and statusgeral = 0");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <option value="<?= $nome_sabor ?> - R$ <?= $valor ?>"><?= $nome_sabor ?> - R$ <?= $valor ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success" name="acao" value="adicionar_torta">Adicionar ao pedido</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal 5 (alfajor) -->
            <div class="modal fade" id="modal5" tabindex="-1" aria-labelledby="modal5Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal5Label">Selecione o alfajor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span style="font-weight: bolder;">Sabores:</span>
                            <select class="form-select" name="alfajor" aria-label="Selecionar Sabor da Torta">
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN saborgeral s ON s.id_geral = p.sabor INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor > 0 and i.id_itens = 4 and statusgeral = 0");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <option value="<?= $nome_sabor ?> - R$ <?= $valor ?>"><?= $nome_sabor ?> - R$ <?= $valor ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success" name="acao" value="adicionar_alfajor">Adicionar ao pedido</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 6 (brigadeiro) -->
            <div class="modal fade" id="modal6" tabindex="-1" aria-labelledby="modal6Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal6Label">Selecione o brigadeiro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span style="font-weight: bolder;">Tamanho:</span>
                            <select class="form-select" name="tamanho_brigadeiro" aria-label="Selecionar Tamanho">

                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN itens i on i.id_itens = p.nome_produto WHERE i.id_itens = 5");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <option value="<?= $tamanho ?> - R$ <?= $valor ?>"><?= $tamanho ?> Unidade - R$ <?= $valor ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <span style="font-weight: bolder;">Sabores</span>
                            <div class="div col-lg-12">
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM brigadeiro WHERE statusbrigadeiro = 0");
                                $sth->execute();
                                $sabores = $sth->fetchAll();
                                $quantidadeDeGrupos = 4;

                                for ($i = 1; $i <= $quantidadeDeGrupos; $i++) {
                                    echo "<span>Sabor $i:</span><br>";
                                    echo '<div class="col-lg-12">';

                                    foreach ($sabores as $res) {
                                        $nome_brigadeiro = htmlspecialchars($res['nome_brigadeiro']);
                                        $id_brigadeiro = htmlspecialchars($res['id_brigadeiro']); ?>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input flavor-radio" type="radio" name="sabor_<?= $i ?>"
                                                value="<?= $nome_brigadeiro ?>" id="sabor_<?= $id_brigadeiro . "_$i" ?>">
                                            <label class="form-check-label" for="sabor_<?= $id_brigadeiro . "_$i" ?>">
                                                <?= $nome_brigadeiro ?>
                                            </label>
                                        </div>
                                <?php
                                    }
                                    echo '</div><br>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success" name="acao" value="adicionar_brigadeiro" onclick="adicionarAoCarrinho()">Adicionar ao pedido</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal 7 (produtos) -->
            <div class="modal fade" id="modal7" tabindex="-1" aria-labelledby="modal7Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal7Label">Selecione o produto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span style="font-weight: bolder;">Produtos:</span>
                            <select class="form-select" name="produtos" aria-label="Selecionar o produto">
                                <?php
                                $sth = $pdo->prepare("SELECT p.*, i.nome_itens AS nome_produto, s.nome_sabor AS sabor FROM produto p INNER JOIN saborgeral s ON s.id_geral = p.sabor INNER JOIN itens i ON i.id_itens = p.nome_produto WHERE p.status = 0 AND i.id_itens > 5");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res);

                                    $produto_json = json_encode([
                                        'nome_produto' => $nome_produto,
                                        'sabor' => $sabor,
                                        'tamanho' => $tamanho,
                                        'valor' => $valor
                                    ]);
                                ?>
                                    <option value='<?= htmlspecialchars($produto_json, ENT_QUOTES, 'UTF-8') ?>'>
                                        <?= $nome_produto ?>, <?= $sabor ?>, <?= $tamanho ?>g - R$ <?= $valor ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success" name="acao" value="adicionar_produto">Adicionar ao pedido</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <!-- Modal 3 -->
            <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal3Label">Pedido</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php
                            include 'ver_carrinho.php';
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</body>

<script src="../../js/script.js"></script>
<script src="../../js/venda.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</html>