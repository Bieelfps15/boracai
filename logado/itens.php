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
    <style>
        .filter-input {
            margin-bottom: 15px;
            max-width: 300px;
        }

        span {
            font-weight: bolder;
        }
    </style>
    <title>Itens registrados</title>
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
                    <a class="nav-link" href="venda/venda.php"><img src="../img/venda.png" class="navbar-toggler-icon" alt="Logo"> Venda</a>
                    <a class="nav-link" href="registros.php"><img src="../img/registros.png" class="navbar-toggler-icon" alt="Logo"> Registros</a>
                    <a class="nav-link active" href="itens.php"><img src="../img/itens.png" class="navbar-toggler-icon" alt="Logo"> Itens</a>
                    <a class="nav-link" href="controle.php"><img src="../img/controle.png" class="navbar-toggler-icon" alt="Logo"> Controle de estoque</a>
                    <a class="nav-link" href="../login/sair.php"> <img src="../img/sair.png" class="navbar-toggler-icon" alt="Logo">Sair</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">



        <!-- Espaço inicial -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        </div>
        <div class="row">
            <h2 style="text-align: center;color: white;">Todos os produtos registrados</h2>


            <!-- Definição das abas -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="menu1-tab" data-bs-toggle="tab" data-bs-target="#menu1" type="button" role="tab" aria-controls="menu1" aria-selected="true">Bolos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu2-tab" data-bs-toggle="tab" data-bs-target="#menu2" type="button" role="tab" aria-controls="menu2" aria-selected="false">Açaí</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu3-tab" data-bs-toggle="tab" data-bs-target="#menu3" type="button" role="tab" aria-controls="menu3" aria-selected="false">Adicionais</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu4-tab" data-bs-toggle="tab" data-bs-target="#menu4" type="button" role="tab" aria-controls="menu4" aria-selected="false">Torta</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu5-tab" data-bs-toggle="tab" data-bs-target="#menu5" type="button" role="tab" aria-controls="menu5" aria-selected="false">Alfajor</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu6-tab" data-bs-toggle="tab" data-bs-target="#menu6" type="button" role="tab" aria-controls="menu6" aria-selected="false">Brigadeiro</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu7-tab" data-bs-toggle="tab" data-bs-target="#menu7" type="button" role="tab" aria-controls="menu7" aria-selected="false">Sabores em geral</button>
                </li>
            </ul>

            <!-- Conteúdo das abas -->
            <div class="tab-content" id="myTabContent">
                <!-- Aba de Bolos -->
                <div id="menu1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="menu1-tab">
                    <h3 style="text-align: center;color: white;">BOLOS DE POTE</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal1" style="float: right;">Adicionar bolo</button>

                    <!-- Campo de busca para Bolos -->
                    <input type="text" id="filterBolos" class="form-control filter-input" placeholder="Buscar nos Bolos">

                    <div class="col-lg-12">
                        <table id="tabelaBolos" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> Sabor </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN saborbolo s ON s.id_bolo = p.sabor INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor > 0 and status = 0;");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <tr>
                                        <td><?= $sabor_bolo ?></td>
                                        <td>R$ <?= $valor ?></td>
                                        <td>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalbolo<?= $id_produto ?>"><img src="../img/editar.png" class="navbar-toggler-icon" alt="Logo"></a>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $id_produto ?>"><img src="../img/delatar.png" class="navbar-toggler-icon" alt="Logo"></a>
                                        </td>
                                    </tr>
                                    <!-- Modal para edição do bolo -->
                                    <div class="modal fade" id="modalbolo<?= $id_produto ?>" tabindex="-1" aria-labelledby="modalboloLabel<?= $id_produto ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalboloLabel<?= $id_produto ?>">Editar valor do bolo "<?= $sabor_bolo ?>"</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="formEdit<?= $id_produto ?>" method="POST" action="acoes/editarbolo.php">
                                                        <span>Preço atual: R$ <?= $valor ?> </span></br>
                                                        <span>Novo preço:</span>
                                                        <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                                                        <input type="text" class="form-control" name="novo_valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço novo do bolo">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-success" onclick="document.getElementById('formEdit<?= $id_produto ?>').submit();">Editar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal para confirmar a exclusão -->
                                    <div class="modal fade" id="modalExcluir<?= $id_produto ?>" tabindex="-1" aria-labelledby="modalExcluirLabel<?= $id_produto ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalExcluirLabel<?= $id_produto ?>">Excluir o bolo "<?= $sabor_bolo ?>"?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="acoes/excluirproduto.php?id=<?= $id_produto ?>" class="btn btn-danger">Deletar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Aba de Açaí -->
                <div id="menu2" class="tab-pane fade" role="tabpanel" aria-labelledby="menu2-tab">
                    <h3 style="text-align: center;color: white;">AÇAÍ</h3>
                    <!-- Campo de busca para Açaí -->
                    <input type="text" id="filterAcai" class="form-control filter-input" placeholder="Buscar no Açaí">
                    <div class="col-lg-12">
                        <table id="tabelaAcai" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> Tamanho </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p  INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor = 0 and p.tamanho > 299;");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <tr>
                                        <td><?= $tamanho ?> ml</td>
                                        <td>R$ <?= $valor ?></td>
                                        <td>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalacai<?= $id_produto ?>"><img src="../img/editar.png" class="navbar-toggler-icon" alt="Deletar"></a>
                                        </td>
                                    </tr>

                                    <!-- Modal para edição do açai -->
                                    <div class="modal fade" id="modalacai<?= $id_produto ?>" tabindex="-1" aria-labelledby="modalacaiLabel<?= $id_produto ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalacaiLabel<?= $id_produto ?>">Editar valor do tamanho <?= $tamanho ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="formEdit<?= $id_produto ?>" method="POST" action="acoes/editartamanho.php">
                                                        <span>Preço atual: R$ <?= $valor ?> </span></br>
                                                        <span>Novo preço:</span>
                                                        <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                                                        <input type="text" class="form-control" name="novo_valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço novo do copo">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-success" onclick="document.getElementById('formEdit<?= $id_produto ?>').submit();">Editar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Aba de Adicionais -->
                <div id="menu3" class="tab-pane fade" role="tabpanel" aria-labelledby="menu3-tab">
                    <h3 style="text-align: center;color: white;">ADICIONAIS</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal2" style="float: right;">Adicionar adicional</button>
                    <!-- Campo de busca para Adicionais -->
                    <input type="text" id="filterAdicionais" class="form-control filter-input" placeholder="Buscar nos Adicionais">

                    <div class="col-lg-12">
                        <table id="tabelaAdicionais" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> Nome </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM adicionais where status_adicional = 0;");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <tr>
                                        <td><?= $nome_adicional ?></td>
                                        <td>R$ <?= $valor_adicional ?></td>
                                        <td>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modaladicional<?= $id_adicional ?>"><img src="../img/editar.png" class="navbar-toggler-icon" alt="Logo"></a>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluirAdicional<?= $id_adicional ?>"><img src="../img/delatar.png" class="navbar-toggler-icon" alt="Deletar"></a>
                                        </td>
                                    </tr>

                                    <!-- Modal para edição do adicional -->
                                    <div class="modal fade" id="modaladicional<?= $id_adicional ?>" tabindex="-1" aria-labelledby="modaladicionalLabel<?= $id_adicional ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modaladicionalLabel<?= $id_adicional ?>">Editar valor do adicional "<?= $nome_adicional ?>"</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="formEdit<?= $id_adicional ?>" method="POST" action="acoes/editaradicional.php">
                                                        <span>Preço atual: R$ <?= $valor_adicional ?> </span></br>
                                                        <span>Novo preço:</span>
                                                        <input type="hidden" name="id_adicional" value="<?= $id_adicional ?>">
                                                        <input type="text" class="form-control" name="valor_adicional" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço novo do adicional">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-success" onclick="document.getElementById('formEdit<?= $id_adicional ?>').submit();">Editar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal para confirmar a exclusão do adicional -->
                                    <div class="modal fade" id="modalExcluirAdicional<?= $id_adicional ?>" tabindex="-1" aria-labelledby="modalExcluirAdicionalLabel<?= $id_adicional ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalExcluirAdicionalLabel<?= $id_adicional ?>">Excluir o adicional "<?= $nome_adicional ?>"?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="acoes/excluiradicional.php?id=<?= $id_adicional ?>" class="btn btn-danger">Deletar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Aba de torta -->
                <div id="menu4" class="tab-pane fade" role="tabpanel" aria-labelledby="menu4-tab">
                    <h3 style="text-align: center;color: white;">Tortas</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal4" style="float: right;">Adicionar torta</button>

                    <!-- Campo de busca para torta -->
                    <input type="text" id="filterBolos" class="form-control filter-input" placeholder="Buscar nas Torta">

                    <div class="col-lg-12">
                        <table id="tabelaTorta" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> Sabor </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN saborgeral s ON s.id_geral = p.sabor2 INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor2 > 0 and statusgeral = 0 and i.id_itens = 3;");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <tr>
                                        <td><?= $nome_sabor ?></td>
                                        <td>R$ <?= $valor ?></td>
                                        <td>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modaltorta<?= $id_produto ?>"><img src="../img/editar.png" class="navbar-toggler-icon" alt="Logo"></a>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $id_produto ?>"><img src="../img/delatar.png" class="navbar-toggler-icon" alt="Logo"></a>
                                        </td>
                                    </tr>
                                    <!-- Modal para edição da torta -->
                                    <div class="modal fade" id="modaltorta<?= $id_produto ?>" tabindex="-1" aria-labelledby="modaltortaLabel<?= $id_produto ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modaltortaLabel<?= $id_produto ?>">Editar valor da torta "<?= $nome_sabor ?>"</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="formEdit<?= $id_produto ?>" method="POST" action="acoes/editarbolo.php">
                                                        <span>Preço atual: R$ <?= $valor ?> </span></br>
                                                        <span>Novo preço:</span>
                                                        <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                                                        <input type="text" class="form-control" name="novo_valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço novo do bolo">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-success" onclick="document.getElementById('formEdit<?= $id_produto ?>').submit();">Editar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal para confirmar a exclusão -->
                                    <div class="modal fade" id="modalExcluir<?= $id_produto ?>" tabindex="-1" aria-labelledby="modalExcluirLabel<?= $id_produto ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalExcluirLabel<?= $id_produto ?>">Excluir o bolo "<?= $sabor_bolo ?>"?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="acoes/excluirproduto.php?id=<?= $id_produto ?>" class="btn btn-danger">Deletar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Aba de alfajor -->
                <div id="menu5" class="tab-pane fade" role="tabpanel" aria-labelledby="menu5-tab">
                    <h3 style="text-align: center;color: white;">Alfajor</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal5" style="float: right;">Adicionar Alfajor</button>

                    <!-- Campo de busca para alfajor -->
                    <input type="text" id="filterAlfajor" class="form-control filter-input" placeholder="Buscar nos Alfajor">

                    <div class="col-lg-12">
                        <table id="tabelaAlfajor" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> Sabor </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN saborgeral s ON s.id_geral = p.sabor2 INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor2 > 0 and statusgeral = 0 and i.id_itens = 4;");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <tr>
                                        <td><?= $nome_sabor ?></td>
                                        <td>R$ <?= $valor ?></td>
                                        <td>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalalfajar<?= $id_produto ?>"><img src="../img/editar.png" class="navbar-toggler-icon" alt="Logo"></a>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $id_produto ?>"><img src="../img/delatar.png" class="navbar-toggler-icon" alt="Logo"></a>
                                        </td>
                                    </tr>
                                    <!-- Modal para edição do alfajor -->
                                    <div class="modal fade" id="modalalfajar<?= $id_produto ?>" tabindex="-1" aria-labelledby="modalalfajarLabel<?= $id_produto ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalalfajarLabel<?= $id_produto ?>">Editar valor do alfajar "<?= $nome_sabor ?>"</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="formEdit<?= $id_produto ?>" method="POST" action="acoes/editaralfajar.php">
                                                        <span>Preço atual: R$ <?= $valor ?> </span></br>
                                                        <span>Novo preço:</span>
                                                        <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                                                        <input type="text" class="form-control" name="novo_valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço novo do alfajar">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-success" onclick="document.getElementById('formEdit<?= $id_produto ?>').submit();">Editar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal para confirmar a exclusão -->
                                    <div class="modal fade" id="modalExcluir<?= $id_produto ?>" tabindex="-1" aria-labelledby="modalExcluirLabel<?= $id_produto ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalExcluirLabel<?= $id_produto ?>">Excluir o alfajar "<?= $nome_sabor ?>"?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="acoes/excluirproduto.php?id=<?= $id_produto ?>" class="btn btn-danger">Deletar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>



                <!-- Aba de brigadeiro -->
                <div id="menu6" class="tab-pane fade" role="tabpanel" aria-labelledby="menu6-tab">
                    <h3 style="text-align: center;color: white;">Brigadeiro</h3>
                    <!-- Campo de busca para brigadeiro -->
                    <input type="text" id="filterBrigadeiro" class="form-control filter-input" placeholder="Buscar no brigadeiro">
                    <div class="col-lg-12">
                        <table id="tabelaBrigadeiro" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> Quantidade </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p  INNER JOIN itens i on i.id_itens = p.nome_produto WHERE  status = 0 and i.id_itens = 5;");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <tr>
                                        <td><?= $tamanho ?> unidade</td>
                                        <td>R$ <?= $valor ?></td>
                                        <td>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalbrigadeiro<?= $id_produto ?>"><img src="../img/editar.png" class="navbar-toggler-icon" alt="Deletar"></a>
                                        </td>
                                    </tr>

                                    <!-- Modal para edição do açai -->
                                    <div class="modal fade" id="modalbrigadeiro<?= $id_produto ?>" tabindex="-1" aria-labelledby="modalbrigadeiroLabel<?= $id_produto ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalbrigadeiroLabel<?= $id_produto ?>">Editar valor do tamanho <?= $tamanho ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="formEdit<?= $id_produto ?>" method="POST" action="acoes/editarbrigadeiro.php">
                                                        <span>Preço atual: R$ <?= $valor ?> </span></br>
                                                        <span>Novo preço:</span>
                                                        <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                                                        <input type="text" class="form-control" name="novo_valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço novo do copo">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-success" onclick="document.getElementById('formEdit<?= $id_produto ?>').submit();">Editar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>






                <!-- Aba de sabores -->
                <div id="menu7" class="tab-pane fade" role="tabpanel" aria-labelledby="menu7-tab">
                    <h3 style="text-align: center;color: white;">Sabores</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal7" style="float: right;">Adicionar Sabor</button>

                    <!-- Campo de busca para Sabores -->
                    <input type="text" id="filterSabores" class="form-control filter-input" placeholder="Buscar nos Sabores">

                    <div class="col-lg-12">
                        <table id="tabelaSabores" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> Sabor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM saborgeral where id_geral > 0 and statusgeral = 0;");
                                $sth->execute();
                                foreach ($sth as $res) {
                                    extract($res); ?>
                                    <tr>
                                        <td><?= $nome_sabor ?></td>
                                        <td>
                                            <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $id_geral ?>"><img src="../img/delatar.png" class="navbar-toggler-icon" alt="Logo"></a>
                                        </td>
                                    </tr>

                                    <!-- Modal para confirmar a exclusão -->
                                    <div class="modal fade" id="modalExcluir<?= $id_geral ?>" tabindex="-1" aria-labelledby="modalExcluirLabel<?= $id_geral ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalExcluirLabel<?= $id_geral ?>">Excluir o sabor "<?= $nome_sabor ?>"?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="acoes/excluirsabor.php?id=<?= $id_geral ?>" class="btn btn-danger">Deletar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>







                <!-- Modal para Adicionar Bolo -->
                <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal1Label">Adicionar Bolo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="acoes/registrarbolo.php">
                                <div class="modal-body">
                                    <span>Sabor:</span>
                                    <input type="text" class="form-control" name="sabor" placeholder="Sabor do bolo" required>
                                    <span>Preço:</span>
                                    <input type="text" class="form-control" name="valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço do bolo">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary" name="action">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para Adicionar adicionais -->
                <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal2Label">Adicionar Bolo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="acoes/registraradicionais.php">
                                <div class="modal-body">
                                    <span>Nome do adicional:</span>
                                    <input type="text" class="form-control" name="nome_adicional" placeholder="Adicional" required>
                                    <span>Preço:</span>
                                    <input type="text" class="form-control" name="valor_adicional" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço do adicional">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary" name="action">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Modal para Adicionar sabores -->
                <div class="modal fade" id="modal7" tabindex="-1" aria-labelledby="modal7Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal7Label">Adicionar Sabor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="acoes/registrarsabor.php">
                                <div class="modal-body">
                                    <span>Nome do sabor:</span>
                                    <input type="text" class="form-control" name="nome_sabor" placeholder="Adicional" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary" name="action">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>



    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script language="javascript">
        function moeda(a, e, r, t) {
            let n = "",
                h = 0,
                u = 0,
                l = "",
                o = window.Event ? t.which : t.keyCode;

            if (o === 13 || o === 8) return true; 

            n = String.fromCharCode(o);

            if (n < '0' || n > '9') return false; 

            u = a.value.length;

            for (h = 0; h < u && (a.value.charAt(h) === '0' || a.value.charAt(h) === r); h++);

            l = "";
            for (; h < u; h++) {
                if ("0123456789".indexOf(a.value.charAt(h)) !== -1) {
                    l += a.value.charAt(h);
                }
            }

            l += n; 

            if (l.length === 0) {
                a.value = "";
            } else if (l.length === 1) {
                a.value = "0" + r + "0" + l;
            } else if (l.length === 2) {
                a.value = "0" + r + l;
            } else {
                let ajd2 = "";
                for (h = l.length - 3, j = 0; h >= 0; h--) {
                    if (j === 3) {
                        ajd2 += e;
                        j = 0;
                    }
                    ajd2 += l.charAt(h);
                    j++;
                }

                a.value = "";
                let tamanho2 = ajd2.length;
                for (h = tamanho2 - 1; h >= 0; h--) {
                    a.value += ajd2.charAt(h);
                }
                a.value += r + l.substr(l.length - 2, 2); 
            }
            return false; 
        }
    </script>

    <script>
        // Modal 1: Foco no input quando o modal é mostrado
        var modal1 = document.getElementById('modal1');
        var inputModal1 = document.getElementById('inputModal1');

        modal1.addEventListener('shown.bs.modal', function() {
            inputModal1.focus();
        });

        // Modal 2: Foco no input quando o modal é mostrado
        var modal2 = document.getElementById('modal2');
        var inputModal2 = document.getElementById('inputModal2');

        modal2.addEventListener('shown.bs.modal', function() {
            inputModal2.focus();
        });

        // Modal 3: Foco no input quando o modal é mostrado
        var modal3 = document.getElementById('modal3');
        var inputModal3 = document.getElementById('inputModal3');

        modal3.addEventListener('shown.bs.modal', function() {
            inputModal3.focus();
        });
    </script>
    <!-- Adicione o script para busca e filtro -->
    <script>
        // Filtros para cada tabela
        document.getElementById('filterBolos').addEventListener('keyup', function() {
            filterTable('filterBolos', 'tabelaBolos');
        });

        document.getElementById('filterAcai').addEventListener('keyup', function() {
            filterTable('filterAcai', 'tabelaAcai');
        });

        document.getElementById('filterAdicionais').addEventListener('keyup', function() {
            filterTable('filterAdicionais', 'tabelaAdicionais');
        });

        document.getElementById('filterTorta').addEventListener('keyup', function() {
            filterTable('filterTorta', 'tabelaTorta');
        });

        document.getElementById('filterAlfajor').addEventListener('keyup', function() {
            filterTable('filterAlfajor', 'tabelaAlfajor');
        });

        document.getElementById('filterBrigadeiro').addEventListener('keyup', function() {
            filterTable('filterBrigadeiro', 'tabelaBrigadeiro');
        });

        document.getElementById('filterSabores').addEventListener('keyup', function() {
            filterTable('filterSabores', 'tabelaSabores');
        });

        // Função de filtro
        function filterTable(inputId, tableId) {
            let input = document.getElementById(inputId);
            let filter = input.value.toLowerCase();
            let table = document.getElementById(tableId);
            let tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        if (td[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                            match = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = match ? "" : "none";
            }
        }
    </script>

</body>

</html>