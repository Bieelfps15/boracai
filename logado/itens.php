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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="imagem/png" href="../img/boraçai.png" />
    <link rel="stylesheet" type="text/css" href="../css/css.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="../css/venda.css">
    <title>Produtos registrados</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand"> <img src="../img/boraçai.png" class="boracai" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="geral.php"><i class="fas fa-chart-line"></i> Dashbord</a>
                    <a class="nav-link" href="venda/venda.php"><i class="fas fa-shopping-cart"></i> Registrar pedido</a>
                    <a class="nav-link" href="registros.php"><i class="fas fa-history"></i> Histórico de pedidos</a>
                    <a class="nav-link active" href="itens.php"><i class="fas fa-box"></i> Produtos</a>
                    <a class="nav-link" href="../login/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">

        <div class="row">

            <header>
                <h2>Todos os produtos registrados</h2>
            </header>

            <!-- Definição das abas -->
            <ul class="nav nav-tabs custom-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="menu1-tab" data-bs-toggle="tab" data-bs-target="#menu1" type="button" role="tab" aria-controls="menu1" aria-selected="true">
                        <i class="fas fa-birthday-cake"></i> Bolos
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu2-tab" data-bs-toggle="tab" data-bs-target="#menu2" type="button" role="tab" aria-controls="menu2" aria-selected="false">
                        <i class="fas fa-ice-cream"></i> Açaí
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu4-tab" data-bs-toggle="tab" data-bs-target="#menu4" type="button" role="tab" aria-controls="menu4" aria-selected="false">
                        <i class="fas fa-pie-chart"></i> Torta
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu5-tab" data-bs-toggle="tab" data-bs-target="#menu5" type="button" role="tab" aria-controls="menu5" aria-selected="false">
                        <i class="fas fa-cookie"></i> Alfajor
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu6-tab" data-bs-toggle="tab" data-bs-target="#menu6" type="button" role="tab" aria-controls="menu6" aria-selected="false">
                        <i class="fas fa-candy-cane"></i> Brigadeiro
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu7-tab" data-bs-toggle="tab" data-bs-target="#menu7" type="button" role="tab" aria-controls="menu7" aria-selected="false">
                        <i class="fas fa-list"></i> Sabores em geral
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu8-tab" data-bs-toggle="tab" data-bs-target="#menu8" type="button" role="tab" aria-controls="menu8" aria-selected="false">
                        <i class="fas fa-box"></i> Outros produtos
                    </button>
                </li>
            </ul>

            <!-- Conteúdo das abas -->
            <div class="tab-content" id="myTabContent">
                <!-- Aba de Bolos -->
                <div id="menu1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="menu1-tab">
                    <h3 style="text-align: center;color: white;padding: 1rem">BOLOS DE POTE</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal1" style="float: right;">Adicionar bolo</button>

                    <!-- Campo de busca para Bolos -->
                    <input type="text" id="filterBolos" class="form-control filter-input" placeholder="Buscar nos Bolos">

                    <div class="col-lg-12">
                        <table id="tabelaBolos" class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th> Sabor </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN saborgeral s ON s.id_geral = p.sabor INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor > 0 and status = 0 and i.id_itens = 2");
                                $sth->execute();
                                $resultados = $sth->fetchAll();

                                if (count($resultados) > 0) {
                                    foreach ($resultados as $res) {
                                        extract($res); ?>
                                        <tr>
                                            <td><?= $nome_sabor ?></td>
                                            <td>R$ <?= $valor ?></td>
                                            <td>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalbolo<?= $id_produto ?>"><i class="fas fa-edit"></i></a>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $id_produto ?>"><i class="fas fa-trash" style="color: red;"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal para edição do bolo -->
                                        <div class="modal fade" id="modalbolo<?= $id_produto ?>" tabindex="-1" aria-labelledby="modalboloLabel<?= $id_produto ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalboloLabel<?= $id_produto ?>">Editar valor do bolo "<?= $nome_sabor ?>"</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="formEdit<?= $id_produto ?>" method="POST" action="acoes/editar/editarbolo.php">
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
                                                        <h5 class="modal-title" id="modalExcluirLabel<?= $id_produto ?>">Remover o bolo "<?= $nome_sabor ?>"?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>O produto não estará mais disponível para venda ou edição. No entanto, se o produto já tiver sido vendido, ele continuará visível nos registros de vendas.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <a href="acoes/deletar/excluirproduto.php?id=<?= $id_produto ?>" class="btn btn-danger">Remover</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="3" style="text-align: center;">Nenhum bolo encontrado.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Aba de Açaí -->
                <div id="menu2" class="tab-pane fade" role="tabpanel" aria-labelledby="menu2-tab">
                    <h3 style="text-align: center;color: white;padding: 1rem">AÇAÍ</h3>
                    <div class="col-lg-12">
                        <table id="tabelaAcai" class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th> Tamanho </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN itens i on i.id_itens = p.nome_produto WHERE i.id_itens = 1;");
                                $sth->execute();
                                $resultados = $sth->fetchAll();

                                if (count($resultados) > 0) {
                                    foreach ($resultados as $res) {
                                        extract($res); ?>
                                        <tr>
                                            <td><?= $tamanho ?> ml</td>
                                            <td>R$ <?= $valor ?></td>
                                            <td>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalacai<?= $id_produto ?>"><i class="fas fa-edit"></i></a>
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
                                                        <form id="formEdit<?= $id_produto ?>" method="POST" action="acoes/editar/editartamanho.php">
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
                                } else {
                                    echo '<tr><td colspan="3" style="text-align: center;">Nenhum açaí encontrado.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <h3 style="text-align: center;color: white;padding: 1rem">ADICIONAIS</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal2" style="float: right;">Adicionar adicional</button>
                    <input type="text" id="filterAdicionais" class="form-control filter-input" placeholder="Buscar nos Adicionais">

                    <div class="col-lg-12">
                        <table id="tabelaAdicionais" class="table table-striped table-bordered">
                            <thead class="thead-dark">
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
                                $resultados = $sth->fetchAll();

                                if (count($resultados) > 0) {
                                    foreach ($resultados as $res) {
                                        extract($res); ?>
                                        <tr>
                                            <td><?= $nome_adicional ?></td>
                                            <td>R$ <?= $valor_adicional ?></td>
                                            <td>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modaladicional<?= $id_adicional ?>"><i class="fas fa-edit"></i></a>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluirAdicional<?= $id_adicional ?>"><i class="fas fa-trash" style="color: red;"></i></a>
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
                                                        <form id="formEdit<?= $id_adicional ?>" method="POST" action="acoes/editar/editaradicional.php">
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
                                                        <h5 class="modal-title" id="modalExcluirAdicionalLabel<?= $id_adicional ?>">Remover o adicional "<?= $nome_adicional ?>"?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>O produto não estará mais disponível para venda ou edição. No entanto, se o produto já tiver sido vendido, ele continuará visível nos registros de vendas.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <a href="acoes/deletar/excluiradicional.php?id=<?= $id_adicional ?>" class="btn btn-danger">Remover</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="3" style="text-align: center;">Nenhum adicional encontrado.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Aba de torta -->
                <div id="menu4" class="tab-pane fade" role="tabpanel" aria-labelledby="menu4-tab">
                    <h3 style="text-align: center;color: white;padding: 1rem">TORTAS</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal4" style="float: right;">Adicionar torta</button>

                    <!-- Campo de busca para torta -->
                    <input type="text" id="filterTorta" class="form-control filter-input" placeholder="Buscar nas Torta">

                    <div class="col-lg-12">
                        <table id="tabelaTorta" class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th> Sabor </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN saborgeral s ON s.id_geral = p.sabor INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor > 0 and status = 0 and i.id_itens = 3;");
                                $sth->execute();
                                $resultados = $sth->fetchAll();

                                if (count($resultados) > 0) {
                                    foreach ($resultados as $res) {
                                        extract($res); ?>
                                        <tr>
                                            <td><?= $nome_sabor ?></td>
                                            <td>R$ <?= $valor ?></td>
                                            <td>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modaltorta<?= $id_produto ?>"><i class="fas fa-edit"></i></a>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $id_produto ?>"><i class="fas fa-trash" style="color: red;"></i></a>
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
                                                        <form id="formEdit<?= $id_produto ?>" method="POST" action="acoes/editar/editartorta.php">
                                                            <span>Preço atual: R$ <?= $valor ?> </span></br>
                                                            <span>Novo preço:</span>
                                                            <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                                                            <input type="text" class="form-control" name="novo_valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço novo da torta">
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
                                                        <h5 class="modal-title" id="modalExcluirLabel<?= $id_produto ?>">Remover a torta "<?= $sabor_bolo ?>"?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>O produto não estará mais disponível para venda ou edição. No entanto, se o produto já tiver sido vendido, ele continuará visível nos registros de vendas.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <a href="acoes/deletar/excluirproduto.php?id=<?= $id_produto ?>" class="btn btn-danger">Remover</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="3" style="text-align: center;">Nenhuma torta encontrada.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Aba de alfajor -->
                <div id="menu5" class="tab-pane fade" role="tabpanel" aria-labelledby="menu5-tab">
                    <h3 style="text-align: center;color: white;padding: 1rem">ALFAJOR</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal5" style="float: right;">Adicionar Alfajor</button>

                    <!-- Campo de busca para alfajor -->
                    <input type="text" id="filterAlfajor" class="form-control filter-input" placeholder="Buscar nos Alfajor">

                    <div class="col-lg-12">
                        <table id="tabelaAlfajor" class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th> Sabor </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM produto p INNER JOIN saborgeral s ON s.id_geral = p.sabor INNER JOIN itens i on i.id_itens = p.nome_produto WHERE p.sabor > 0 and status = 0 and i.id_itens = 4;");
                                $sth->execute();
                                $resultados = $sth->fetchAll();

                                if (count($resultados) > 0) {
                                    foreach ($resultados as $res) {
                                        extract($res); ?>
                                        <tr>
                                            <td><?= $nome_sabor ?></td>
                                            <td>R$ <?= $valor ?></td>
                                            <td>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalalfajar<?= $id_produto ?>"><i class="fas fa-edit"></i></a>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $id_produto ?>"><i class="fas fa-trash" style="color: red;"></i></a>
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
                                                        <form id="formEdit<?= $id_produto ?>" method="POST" action="acoes/editar/editaralfajar.php">
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
                                                        <h5 class="modal-title" id="modalExcluirLabel<?= $id_produto ?>">Remover o alfajar "<?= $nome_sabor ?>"?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>O produto não estará mais disponível para venda ou edição. No entanto, se o produto já tiver sido vendido, ele continuará visível nos registros de vendas.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <a href="acoes/deletar/excluirproduto.php?id=<?= $id_produto ?>" class="btn btn-danger">Remover</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="3" style="text-align: center;">Nenhum aljafar encontrado.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Aba de brigadeiro -->
                <div id="menu6" class="tab-pane fade" role="tabpanel" aria-labelledby="menu6-tab">
                    <h3 style="text-align: center;color: white;padding: 1rem">BRIGADEIRO</h3>
                    <div class="col-lg-12">
                        <table id="tabelaBrigadeiro" class="table table-striped table-bordered">
                            <thead class="thead-dark">
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
                                $resultados = $sth->fetchAll();

                                if (count($resultados) > 0) {
                                    foreach ($resultados as $res) {
                                        extract($res); ?>
                                        <tr>
                                            <td><?= $tamanho ?> unidade</td>
                                            <td>R$ <?= $valor ?></td>
                                            <td>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalbriga<?= $id_produto ?>"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Modal para edição do brigadeiro -->
                                        <div class="modal fade" id="modalbriga<?= $id_produto ?>" tabindex="-1" aria-labelledby="modalbrigaLabel<?= $id_produto ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalbrigaLabel<?= $id_produto ?>">Editar valor do brigadeiro com (<?= $tamanho ?>) un</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="form<?= $id_produto ?>" method="POST" action="acoes/editar/editarbrigadeiro.php">
                                                            <span>Preço atual: R$ <?= $valor ?> </span></br>
                                                            <span>Novo preço:</span>
                                                            <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                                                            <input type="text" class="form-control" name="novo_valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço novo">
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-success" onclick="document.getElementById('form<?= $id_produto ?>').submit();">Editar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="3" style="text-align: center;">Nenhum brigadeiro encontrado.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <h3 style="text-align: center;color: white;padding: 1rem">SABORES PARA O BRIGADEIRO</h3>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal8" style="float: right;">Adicionar sabor do brigadeiro</button>
                    <!-- Campo de busca para brigadeiro -->
                    <input type="text" id="filterBrigadeiro1" class="form-control filter-input" placeholder="Buscar no sabores para o brigadeiro">
                    <div class="col-lg-12">
                        <table id="tabelaBrigadeiro1" class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th> Sabor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT *FROM brigadeiro WHERE statusbrigadeiro = 0");
                                $sth->execute();
                                $resultados = $sth->fetchAll();

                                if (count($resultados) > 0) {
                                    foreach ($resultados as $res) {
                                        extract($res); ?>
                                        <tr>
                                            <td><?= $nome_brigadeiro ?></td>
                                            <td>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalbrigadeiro1<?= $id_brigadeiro ?>"><i class="fas fa-trash" style="color: red;"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal para confirmar a exclusão -->
                                        <div class="modal fade" id="modalbrigadeiro1<?= $id_brigadeiro ?>" tabindex="-1" aria-labelledby="modalbrigadeiro1Label<?= $id_brigadeiro ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalbrigadeiro1Label<?= $id_brigadeiro ?>">Remover o sabor "<?= $nome_brigadeiro ?>"?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>O produto não estará mais disponível para venda ou edição. No entanto, se o produto já tiver sido vendido, ele continuará visível nos registros de vendas.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <a href="acoes/deletar/excluibrigadeiro.php?id=<?= $id_brigadeiro ?>" class="btn btn-danger">Remover</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                <?php
                                    }
                                } else {
                                    // Mensagem quando não há resultados
                                    echo '<tr><td colspan="3" style="text-align: center;">Nenhum sabor de brigadeiro encontrado.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>








                <!-- Aba de sabores -->
                <div id="menu7" class="tab-pane fade" role="tabpanel" aria-labelledby="menu7-tab">
                    <h3 style="text-align: center;color: white;padding: 1rem">SABORES</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal7" style="float: right;">Adicionar Sabor</button>

                    <!-- Campo de busca para Sabores -->
                    <input type="text" id="filterSabores" class="form-control filter-input" placeholder="Buscar nos Sabores">

                    <div class="col-lg-12">
                        <table id="tabelaSabores" class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th> Sabor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT *FROM saborgeral where id_geral > 0 and statusgeral = 0;");
                                $sth->execute();
                                $resultados = $sth->fetchAll();

                                if (count($resultados) > 0) {
                                    foreach ($resultados as $res) {
                                        extract($res); ?>
                                        <tr>
                                            <td><?= $nome_sabor ?></td>
                                            <td>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluirsab<?= $id_geral ?>"><i class="fas fa-trash" style="color: red;"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Modal para confirmar a exclusão -->
                                        <div class="modal fade" id="modalExcluirsab<?= $id_geral ?>" tabindex="-1" aria-labelledby="modalExcluirsabLabel<?= $id_geral ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalExcluirsabLabel<?= $id_geral ?>">Remover o sabor "<?= $nome_sabor ?>"?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>O produto não estará mais disponível para venda ou edição. No entanto, se o produto já tiver sido vendido, ele continuará visível nos registros de vendas.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <a href="acoes/deletar/excluirsabor.php?id=<?= $id_geral ?>" class="btn btn-danger">Remover</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    // Mensagem quando não há resultados
                                    echo '<tr><td colspan="3" style="text-align: center;">Nenhum sabor encontrado.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Aba de outros produtos -->
                <div id="menu8" class="tab-pane fade" role="tabpanel" aria-labelledby="menu8-tab">
                    <h3 style="text-align: center;color: white;padding: 1rem">OUTROS PRODUTOS</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal9" style="float: right;">Adicionar produto</button>

                    <!-- Campo de busca para outros produtos -->
                    <input type="text" id="filterOutros" class="form-control filter-input" placeholder="Buscar nos outros produtos">

                    <div class="col-lg-12">
                        <table id="tabelaAlfajor" class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th> Nome </th>
                                    <th> Sabor </th>
                                    <th> Tamanho </th>
                                    <th> Valor </th>
                                    <th> Edição </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT p.*, i.nome_itens AS nome_produto, s.nome_sabor AS sabor FROM produto p INNER JOIN saborgeral s ON s.id_geral = p.sabor INNER JOIN itens i ON i.id_itens = p.nome_produto WHERE p.status = 0 AND i.id_itens > 5");
                                $sth->execute();
                                $resultados = $sth->fetchAll();

                                if (count($resultados) > 0) {
                                    foreach ($resultados as $res) {
                                        extract($res); ?>
                                        <tr>
                                            <td><?= $nome_produto ?></td>
                                            <td><?= $sabor ?></td>
                                            <td><?= $tamanho ?> g</td>
                                            <td>R$ <?= $valor ?></td>
                                            <td>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalprodutos<?= $id_produto ?>"><i class="fas fa-edit"></i></a>
                                                <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $id_produto ?>"><i class="fas fa-trash" style="color: red;"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal para edição de outros produtos -->
                                        <div class="modal fade" id="modalprodutos<?= $id_produto ?>" tabindex="-1" aria-labelledby="modalprodutosLabel<?= $id_produto ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalprodutosLabel<?= $id_produto ?>">Editar valor: <?= $nome_produto ?>, sabor: <?= $sabor ?>, tamanho: <?= $tamanho ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="formEdit<?= $id_produto ?>" method="POST" action="acoes/editar/editarproduto.php">
                                                            <span>Preço atual: R$ <?= $valor ?> </span></br>
                                                            <span>Novo preço:</span>
                                                            <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                                                            <input type="text" class="form-control" name="novo_valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço novo">
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
                                                        <h5 class="modal-title" id="modalExcluirLabel<?= $id_produto ?>">Remover o produto "<?= $nome_produto ?>, sabor: <?= $sabor ?>, tamanho: <?= $tamanho ?>"?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>O produto não estará mais disponível para venda ou edição. No entanto, se o produto já tiver sido vendido, ele continuará visível nos registros de vendas.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <a href="acoes/deletar/excluirproduto.php?id=<?= $id_produto ?>" class="btn btn-danger">Remover</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="5" style="text-align: center;">Nenhum produto encontrado.</td></tr>';
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
                            <form method="POST" action="acoes/adicionar/registrarbolo.php">
                                <div class="modal-body">
                                    <span>Sabor:</span>
                                    <select required class='form-select' id="sabores2" name="sabores">
                                        <option value='' disabled selected>Escolha um sabor</option>
                                        <?php
                                        $sth = $pdo->prepare("SELECT * FROM saborgeral where statusgeral = 0");
                                        $sth->execute();
                                        foreach ($sth as $res) {
                                            extract($res); ?>
                                            <option value="<?= $id_geral ?>"><?= $nome_sabor ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option value="outrosabor">Outro (Adicionar novo)</option>
                                    </select>
                                    <div id="novosaborbolo" class="mt-3" style="display:none;">
                                        <input type="text" class="form-control" name="novo_sabor" placeholder="Digite o novo sabor">
                                    </div>
                                    <span>Preço:</span>
                                    <input type="text" class="form-control" name="valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço do bolo">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-success" name="action">Adicionar</button>
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
                                <h5 class="modal-title" id="modal2Label">Adicionar adicionais</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="acoes/adicionar/registraradicionais.php">
                                <div class="modal-body">
                                    <span>Nome do adicional:</span>
                                    <input type="text" class="form-control" name="nome_adicional" placeholder="Adicional" required>
                                    <span>Preço:</span>
                                    <input type="text" class="form-control" name="valor_adicional" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço do adicional">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-success" name="action">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para Adicionar torta -->
                <div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="modal4Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal4Label">Adicionar Torta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <span>Sabor da torta:</span>
                                <form method="POST" action="acoes/adicionar/registrartorta.php">
                                    <select required class='form-select' id="sabores" name="sabores">
                                        <option value='' disabled selected>Escolha um sabor</option>
                                        <?php
                                        $sth = $pdo->prepare("SELECT * FROM saborgeral where statusgeral = 0");
                                        $sth->execute();
                                        foreach ($sth as $res) {
                                            extract($res); ?>
                                            <option value="<?= $id_geral ?>"><?= $nome_sabor ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option value="outrosabor">Outro (Adicionar novo)</option>
                                    </select>
                                    <div id="novosabortorta" class="mt-3" style="display:none;">
                                        <input type="text" class="form-control" name="novo_sabor" placeholder="Digite o novo sabor">
                                    </div>
                                    <span>Preço:</span>
                                    <input type="text" class="form-control" name="valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço da torta">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success" name="action">Adicionar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para Adicionar alfajor -->
                <div class="modal fade" id="modal5" tabindex="-1" aria-labelledby="modal5Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal5Label">Adicionar Alfajor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <span>Sabor do alfajor:</span>
                                <form method="POST" action="acoes/adicionar/registraralfajor.php">
                                    <select required class='form-select' id="sabores1" name="sabores">
                                        <option value='' disabled selected>Escolha um sabor</option>
                                        <?php
                                        $sth = $pdo->prepare("SELECT * FROM saborgeral where statusgeral = 0");
                                        $sth->execute();
                                        foreach ($sth as $res) {
                                            extract($res); ?>
                                            <option value="<?= $id_geral ?>"><?= $nome_sabor ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option value="outrosabor">Outro (Adicionar novo)</option>
                                    </select>
                                    <div id="novosaboralfajor" class="mt-3" style="display:none;">
                                        <input type="text" class="form-control" name="novo_sabor" placeholder="Digite o novo sabor">
                                    </div>
                                    <span>Preço:</span>
                                    <input type="text" class="form-control" name="valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço do alfajor">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success" name="action">Adicionar</button>
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
                            <form method="POST" action="acoes/adicionar/registrarsabor.php">
                                <div class="modal-body">
                                    <span>Nome do sabor:</span>
                                    <input type="text" class="form-control" name="nome_sabor" placeholder="Adicional" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-success" name="action">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para Adicionar sabores brigadeiro -->
                <div class="modal fade" id="modal8" tabindex="-1" aria-labelledby="modal8Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal8Label">Adicionar Sabor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="acoes/adicionar/registrarbrigadeiro.php">
                                <div class="modal-body">
                                    <span>Nome do sabor:</span>
                                    <input type="text" class="form-control" name="nome_brigadeiro" placeholder="Adicional" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-success" name="action">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para Adicionar outros produtos -->
                <div class="modal fade" id="modal9" tabindex="-1" aria-labelledby="modal9Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal9Label">Adicionar produto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="acoes/adicionar/registrarproduto.php">
                                <div class="modal-body">
                                    <span>Tipo do produto:</span>
                                    <select class="form-select" id="tipoProduto" name="tipo_produto" required>
                                        <option value='' disabled selected>Escolha um tipo</option>
                                        <?php
                                        $sth = $pdo->prepare("SELECT * FROM itens where id_itens > 5");
                                        $sth->execute();
                                        foreach ($sth as $res) {
                                            extract($res); ?>
                                            <option value="<?= $id_geral ?>"><?= $nome_itens ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option value="outro">Outro (Adicionar novo)</option>
                                    </select>
                                    <div id="novoTipoProduto" class="mt-3" style="display:none;">
                                        <input type="text" class="form-control" name="novo_tipo_produto" placeholder="Digite o novo tipo de produto">
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-primary" id="btnAdicionarSabor">Adicionar Sabor</button>
                                        <button type="button" class="btn btn-secondary" id="btnAdicionarTamanho">Adicionar Tamanho</button>
                                    </div>

                                    <div id="saborInput" class="mt-3" style="display:none;">
                                        <select required class='form-select' id="saborProduto" name="sabor">
                                            <option value='' disabled selected>Escolha um sabor</option>
                                            <?php
                                            $sth = $pdo->prepare("SELECT * FROM saborgeral where statusgeral = 0");
                                            $sth->execute();
                                            foreach ($sth as $res) {
                                                extract($res); ?>
                                                <option value="<?= $id_geral ?>"><?= $nome_sabor ?></option>
                                            <?php
                                            }
                                            ?>
                                            <option value="outrosabor">Outro (Adicionar novo)</option>
                                        </select>
                                        <div id="novosaborproduto" class="mt-3" style="display:none;">
                                            <input type="text" class="form-control" name="novo_sabor" placeholder="Digite o novo sabor">
                                        </div>
                                    </div>

                                    <div id="tamanhoInput" class="mt-3" style="display:none;">
                                        <p>Tamanho em gramas(sem vírgulas ou pontos)</p>
                                        <input type="text" class="form-control" name="tamanho" placeholder="Digite o tamanho">
                                    </div>
                                    <span>Preço:</span>
                                    <input type="text" class="form-control" name="valor" inputmode="numeric" pattern="[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?" onKeyPress="return(moeda(this,'.',',',event))" required="required" placeholder="Preço do produto">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-success" name="action">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <script src="../js/scripts.js"></script>
    <script src="../js/item.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



</body>

</html>