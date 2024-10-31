<?php
session_start();
if (!$_SESSION['boracai']) :
  header("Location: ../index.php");
  die;
endif;

include 'dashbord/dados.php';
?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="imagem/png" href="../img/boraçai.png" />
  <link rel="stylesheet" type="text/css" href="../css/css.css">
  <link rel="stylesheet" href="../css/itens.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Dashbord</title>
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
          <a class="nav-link active" href="geral.php"><i class="fas fa-chart-line"></i> Dashbord</a>
          <a class="nav-link" href="venda/venda.php"><i class="fas fa-shopping-cart"></i> Registrar pedido</a>
          <a class="nav-link" href="registros.php"><i class="fas fa-history"></i> Histórico de pedidos</a>
          <a class="nav-link" href="itens.php"><i class="fas fa-box"></i> Produtos</a>
          <a class="nav-link" href="../login/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid">

    <!-- Espaço inicial -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    </div>

    <div class="row">

      <!-- Card do vendas do dia -->
      <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Vendas do dia</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php

                                                                      include '../conexao.php';

                                                                      $sth = $pdo->prepare("SELECT SUM(valortotal) AS total_vendas FROM (SELECT DISTINCT p.numeropedido, p.valortotal FROM pedido p JOIN numeropedido n ON p.numeropedido = n.id WHERE DATE(n.data) = CURDATE()) AS unique_pedidos");

                                                                      $sth->execute();
                                                                      $res = $sth->fetch(PDO::FETCH_ASSOC);
                                                                      if ($res) {
                                                                        echo "R$ " . number_format($res['total_vendas'], 2, ',', '.');
                                                                      } else {
                                                                        echo "R$ 0,00";
                                                                      }
                                                                      ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar text-primary fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card do vendas totais -->
      <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Vendas total</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php

                                                                      include '../conexao.php';

                                                                      $sth = $pdo->prepare("SELECT SUM(total_pedido) AS total_vendas FROM (SELECT numeropedido, MAX(valortotal) AS total_pedido FROM pedido GROUP BY numeropedido) AS pedidos_agrupados;");

                                                                      $sth->execute();
                                                                      foreach ($sth as $res) {
                                                                        extract($res);
                                                                        echo "R$ " . number_format($res['total_vendas'], 2, ',', '.');
                                                                      }
                                                                      ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-dollar-sign text-success fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card do vendas totais com taxa -->
      <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    Total com descontos</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php

                                                                      include '../conexao.php';

            $sth = $pdo->prepare("SELECT SUM(CASE 
            WHEN pagamento = 'ifood' THEN total_pedido * 0.88 
            WHEN pagamento = 'credito' THEN total_pedido * 0.965  
            WHEN pagamento = 'debito' THEN total_pedido * 0.985  
            ELSE total_pedido END ) AS total_com_desconto FROM (SELECT numeropedido, pagamento, MAX(valortotal) AS total_pedido FROM pedido GROUP BY numeropedido, pagamento ) AS pedidos_agrupados;");

                                                                      $sth->execute();
                                                                      foreach ($sth as $res) {
                                                                        extract($res);
                                                                        echo "R$ " . number_format($res['total_com_desconto'], 2, ',', '.');
                                                                      }
                                                                      ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comment-dollar text-warning fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-12 col-lg-12">
        <div class="card shadow">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary fas fa-chart-line"> Vendas de cada dia</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myAreaChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <header>
        <h2>Análise de vendas por produto</h2>
      </header>

      <div class="col-xl-4 col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary fas fa-chart-pie"> Copos de açaí mais vendidos</h6>
            <div class="dropdown no-arrow">
            </div>
          </div>
          <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
              <canvas id="myPieChart" style="height: 600px; width: 70%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary fas fa-chart-bar"> Adicionais mais vendidos</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="adicionaisBarChart" style="height: 600px; width: 70%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary fas fa-chart-bar"> Sabores de bolos mais vendidos</h6>
          </div>
          <div class="card-body">
            <div class="chart-bar">
              <canvas id="bolosBarChart" style="height: 600px; width: 70%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary fas fa-chart-bar"> Tortas mais vendidos</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="tortaBarChart" style="height: 600px; width: 70%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary fas fa-chart-bar"> Alfajor mais vendidos</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="alfajorBarChart" style="height: 600px; width: 70%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary fas fa-chart-pie"> Combinações de brigadeiros mais vendidos</h6>
            <div class="dropdown no-arrow">
            </div>
          </div>
          <div class="card-body">
            <div class="chart-pie1 pt-4 pb-2">
              <canvas id="myPieChart1" style="height: 600px; width: 70%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row" id="chartsContainer">
        </div>
      </div>




    </div>
  </div>




</body>

<script>
  function fetchItens() {
    fetch('dashbord/selecionaritens.php')
      .then(response => response.json())
      .then(itens => {
        console.log("Itens retornados:", itens);
        itens.forEach(item => {
          createBarChartForItem(item.nome);
        });
      })
      .catch(error => console.error("Erro ao buscar itens:", error));
  }

  function createBarChartForItem(nomeItem) {
    fetch('dashbord/buscavendaitens.php?nome=' + encodeURIComponent(nomeItem))
      .then(response => response.json())
      .then(data => {
        console.log("Dados para o item", nomeItem, data);

        const chartId = `chart-${nomeItem.replace(/\s+/g, '-')}`;
        const chartContainer = document.createElement('div');
        chartContainer.classList.add('col-xl-4', 'col-lg-12', 'mb-4');
        chartContainer.innerHTML = `
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary fas fa-chart-pie"> ${nomeItem} mais vendidos</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="${chartId}" style="height: 600px; width: 70%;"></canvas>
                                </div>
                            </div>
                        </div>
                    `;
        document.getElementById('chartsContainer').appendChild(chartContainer);

        var ctx = document.getElementById(chartId).getContext('2d');
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: data.labels, // Rótulos dos produtos vendidos
            datasets: [{
              label: "Quantidade",
              backgroundColor: "#4e73df",
              borderColor: "#4e73df",
              data: data.values, // Quantidades de vendas para cada rótulo
            }],
          },
          options: {
            maintainAspectRatio: false,
            layout: {
              padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
              }
            },
            scales: {
              xAxes: [{
                gridLines: {
                  display: false,
                  drawBorder: false
                },
                ticks: {
                  maxTicksLimit: 6
                },
                maxBarThickness: 25,
              }],
              yAxes: [{
                ticks: {
                  min: 0,
                  max: Math.max(...data.values) + 2, // Ajusta o máximo com base nos valores
                  padding: 10,
                  callback: function(value) {
                    return '' + value;
                  }
                },
                gridLines: {
                  color: "rgb(234, 236, 244)",
                  zeroLineColor: "rgb(234, 236, 244)",
                  drawBorder: false,
                  borderDash: [2],
                  zeroLineBorderDash: [2]
                }
              }],
            },
            legend: {
              display: false
            },
            tooltips: {
              titleMarginBottom: 10,
              titleFontColor: '#6e707e',
              titleFontSize: 14,
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#858796",
              borderColor: '#dddfeb',
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              caretPadding: 10,
              callbacks: {
                label: function(tooltipItem, chart) {
                  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                  return datasetLabel + ': ' + tooltipItem.yLabel;
                }
              }
            },
          }
        });
      })
      .catch(error => console.error("Erro ao buscar dados para o item", nomeItem, error));
  }

  // Chama a função para buscar e gerar gráficos ao carregar a página
  fetchItens();
</script>
<script>
  // Gráfico de Área
  var ctx = document.getElementById("myAreaChart").getContext('2d');
  var myAreaChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode(array_reverse($datas)); ?>, // Datas
      datasets: [{
        label: "Total de Vendas (R$)",
        backgroundColor: "rgba(78, 115, 223, 2.0)",
        borderColor: "rgba(78, 115, 223, 1.0)",
        data: <?php echo json_encode(array_reverse($vendas)); ?>, // Valores de vendas
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          time: {
            unit: 'day',
          },
          grid: {
            display: false,
          },
          ticks: {
            maxTicksLimit: 7,
          },
        },
        y: {
          grid: {
            color: "rgba(234, 236, 244, .1)",
          },
          ticks: {
            beginAtZero: true,
            maxTicksLimit: 5,
            padding: 10,
          },
        },
      },
      legend: {
        display: true,
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
    },
  });

  // Dados do gráfico
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: <?php echo json_encode($tamanhos); ?>,
      datasets: [{
        data: <?php echo json_encode($quantidades1); ?>,
        backgroundColor: [
          'rgba(78, 115, 223, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 193, 7, 1)',
          'rgba(28, 200, 138, 1)',
          'rgba(54, 185, 204, 1)',
        ],
        hoverOffset: 4
      }],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'top',
        },
      },
    },
  });

  // Dados do gráfico
  var ctx = document.getElementById("myPieChart1");
  var myPieChart1 = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: <?php echo json_encode($combinacoes); ?>,
      datasets: [{
        data: <?php echo json_encode($quantidades); ?>,
        backgroundColor: [
          'rgba(78, 115, 223, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 193, 7, 1)',
          'rgba(28, 200, 138, 1)',
          'rgba(54, 185, 204, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(255, 159, 64, 1)',
        ],
        hoverOffset: 4
      }],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'top',
        },
      },
    },
  });


  // Dados para o gráfico de barras dos sabores de bolos
  var ctx = document.getElementById("bolosBarChart").getContext('2d');
  var bolosBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($sabores_bolo); ?>, // Nomes dos sabores
      datasets: [{
        label: "Quantidade",
        backgroundColor: "#4e73df",
        borderColor: "#4e73df",
        data: <?php echo json_encode($quantidades_bolo); ?>, // Quantidades de cada sabor
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'Bolo'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 6
          },
          maxBarThickness: 25,
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: Math.max(...<?php echo json_encode($quantidades_bolo); ?>) + 2, // Ajusta o máximo com base nos valores dos bolos
            padding: 10,
            // Inclui um valor de quantidade no eixo y
            callback: function(value, index, values) {
              return '' + value;
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel;
          }
        }
      },
    }
  });

  // Dados para o gráfico de barras dos adicionais
  var ctxAdicional = document.getElementById("adicionaisBarChart").getContext('2d');
  var adicionaisBarChart = new Chart(ctxAdicional, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($adicionais); ?>, // Nomes dos adicionais
      datasets: [{
        label: "Quantidade",
        backgroundColor: "#4e73df", // Cor dos adicionais
        borderColor: "#4e73df",
        data: <?php echo json_encode($quantidades_adicionais); ?>, // Quantidades de cada adicional
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'Adicional' // O eixo x está rotulado como 'Adicional'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 6 // Limita o número de ticks no eixo x
          },
          maxBarThickness: 25, // Ajusta a largura das barras
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: Math.max(...<?php echo json_encode($quantidades_adicionais); ?>) + 2, // Ajusta o máximo com base nos valores dos adicionais
            padding: 10,
            // Inclui um valor de quantidade no eixo y
            callback: function(value) {
              return '' + value; // Exibe os valores no eixo y
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false // Oculta a legenda
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel; // Exibe a quantidade no tooltip
          }
        }
      },
    }
  });

  // Dados para o gráfico de barras das tortas
  var ctx = document.getElementById("tortaBarChart").getContext('2d');
  var bolosBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($sabores_torta); ?>, // Nomes das tortas
      datasets: [{
        label: "Quantidade",
        backgroundColor: "#4e73df",
        borderColor: "#4e73df",
        data: <?php echo json_encode($quantidades_torta); ?>, // Quantidades de cada torta
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'Torta'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 6
          },
          maxBarThickness: 25,
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: Math.max(...<?php echo json_encode($quantidades_torta); ?>) + 2, // Ajusta o máximo com base nos valores das tortas
            padding: 10,
            // Inclui um valor de quantidade no eixo y
            callback: function(value, index, values) {
              return '' + value;
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel;
          }
        }
      },
    }
  });

  // Dados para o gráfico de barras das alfajor
  var ctx = document.getElementById("alfajorBarChart").getContext('2d');
  var bolosBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($sabores_alfajor); ?>, // Nomes das alfajor
      datasets: [{
        label: "Quantidade",
        backgroundColor: "#4e73df",
        borderColor: "#4e73df",
        data: <?php echo json_encode($quantidades_alfajor); ?>, // Quantidades de cada alfajor
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'Torta'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 6
          },
          maxBarThickness: 25,
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: Math.max(...<?php echo json_encode($quantidades_alfajor); ?>) + 2, // Ajusta o máximo com base nos valores das tortas
            padding: 10,
            // Inclui um valor de quantidade no eixo y
            callback: function(value, index, values) {
              return '' + value;
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel;
          }
        }
      },
    }
  });
</script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>