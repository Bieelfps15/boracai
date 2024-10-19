<?php
session_start();
if (!$_SESSION['boracai']) :
    header("Location: ../index.php");
    die;
endif;

include '../conexao.php';
include 'tabela/tabela.php';

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashbord</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate,
        .dataTables_wrapper .dataTables_info {
            color: white;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            color: white;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            vertical-align: middle;
        }

        .navbar-nav a:hover {
            transform: scale(1.1);
        }
    </style>
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
                    <a class="nav-link active" href="registros.php"><img src="../img/registros.png" class="navbar-toggler-icon" alt="Logo"> Registros</a>
                    <a class="nav-link" href="itens.php"><img src="../img/itens.png" class="navbar-toggler-icon" alt="Logo"> Itens</a>
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
            <h2 style="text-align: center;color: white;">Registros de pedidos</h2>
            <div class="table-responsive">
                <table id="recordsTable" class="table table-striped table-bordered">
                <thead class="thead-dark" style="background-color: #343a40; color: white;">
                        <tr>
                            <th>Pedido</th>
                            <th>Produto vendido</th>
                            <th>Adicional</th>
                            <th>Forma de Pagamento</th>
                            <th>Taxa de entrega</th>
                            <th>Valor total</th>
                            <th>Responsável</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($pedidos as $pedido) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($pedido['numeropedido']) . "</td>";
                                echo "<td>" . htmlspecialchars($pedido['produtos_vendidos']) . "</td>";
                                echo "<td>" . (empty($pedido['adicionais']) ? 'Nenhum' : htmlspecialchars($pedido['adicionais'])) . "</td>";
                                echo "<td>" . htmlspecialchars($pedido['pagamento']) . "</td>";
                                echo "<td>R$ " . number_format($pedido['taxaentrega'], 2, ',', '.') . "</td>";
                                echo "<td>R$ " . number_format($pedido['valortotal'], 2, ',', '.') . "</td>";
                                echo "<td>" . htmlspecialchars($pedido['responsavel']) . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#recordsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros totais)",
                "search": "Pesquisar:",
                "paginate": {
                    "next": "Próximo",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>


</html>