<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boracai";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o carrinho está vazio
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "<div class='alert alert-danger'>O carrinho está vazio. Não é possível finalizar o pedido.</div>";
    exit;
}

// Aqui você pode processar a forma de pagamento e o valor total
$forma_pagamento = $_POST['forma_pagamento'];
$valor_total = $_POST['valor_total'];
$taxa_entrega = isset($_POST['taxa_entrega']) ? $_POST['taxa_entrega'] : 0;

function convertToFloat($value)
{
    $normalizedValue = str_replace(',', '.', $value);
    return floatval($normalizedValue);
}

$valor_total_float = convertToFloat($valor_total);
$taxa_entrega_float = convertToFloat($taxa_entrega);
$total_final = $valor_total_float + $taxa_entrega_float;
$total_final_formatado = number_format($total_final, 2, '.', '');

// 1. Insira um novo número de pedido na tabela numeropedido
$query_numero_pedido = "INSERT INTO numeropedido (data) VALUES (NOW())";
if (!mysqli_query($conn, $query_numero_pedido)) {
    echo "Erro ao inserir número do pedido: " . mysqli_error($conn);
    exit;
}
$numero_pedido_id = mysqli_insert_id($conn); // Obtém o ID do último pedido inserido

// 2. Obtendo o nome da pessoa que está com a sessão aberta
if (isset($_SESSION['boracai']['id_pessoa'])) {
    $id_pessoa = $_SESSION['boracai']['id_pessoa'];

    $query_nome = "SELECT nome_pessoa FROM pessoa WHERE id_pessoa = '$id_pessoa'";
    $result_nome = mysqli_query($conn, $query_nome);

    if ($result_nome) {
        if (mysqli_num_rows($result_nome) > 0) {
            $row_nome = mysqli_fetch_assoc($result_nome);
            $nome_responsavel = $row_nome['nome_pessoa'];
        } else {
            $nome_responsavel = 'Desconhecido';
        }
    } else {
        echo "Erro na consulta: " . mysqli_error($conn);
        $nome_responsavel = 'Desconhecido';
    }
} else {
    $nome_responsavel = 'Desconhecido';
}

// 3. Insira os produtos do carrinho na tabela pedido
foreach ($_SESSION['carrinho'] as $item) {
    // Ajusta o nome do produto
    if ($item['tipo'] == 'açaí') {
        $nome_produto_base = $item['nome'];
        $tamanho = explode(" - R$", $item['tamanho'])[0];
        $nome_produto = $nome_produto_base . " " . $tamanho;
    } elseif ($item['tipo'] == 'bolo') {
        $nome_produto_base = $item['nome'];
        $sabor = explode(" - R$", $item['sabor'])[0];
        $nome_produto = $nome_produto_base . " de " . $sabor;
    } elseif ($item['tipo'] == 'torta') {
        $nome_produto_base = $item['nome'];
        $sabor = explode(" - R$", $item['sabor'])[0];
        $nome_produto = $nome_produto_base . " de " . $sabor;
    } elseif ($item['tipo'] == 'alfajor') {
        $nome_produto_base = $item['nome'];
        $sabor = explode(" - R$", $item['sabor'])[0];
        $nome_produto = $nome_produto_base . " de " . $sabor;
    } elseif ($item['tipo'] == 'brigadeiro') {
        $nome_produto_base = $item['nome'];
        $tamanho = $item['tamanho'];
        $nome_produto = $nome_produto_base . " (" . $tamanho . " un.)";
    } elseif ($item['tipo'] == 'produto') {
        $nome_produto_base = $item['nome']; 
        $sabor = isset($item['sabor']) ? $item['sabor'] : 'N/A'; 
        $tamanho = isset($item['tamanho']) ? $item['tamanho'] . 'g' : 'N/A';
        $nome_produto = $nome_produto_base . " de " . $sabor . " - " . $tamanho;
    }

    // Captura os adicionais
    $adicionais = isset($item['adicionais']) ? array_map(function ($adicional) {
        return explode(" - R$", $adicional)[0];
    }, $item['adicionais']) : [];

    // Verifica se 'sabores' é uma string e não um array
    if (isset($item['sabores']) && !empty($item['sabores'])) {
        // Se for uma string separada por vírgula, convertê-la em um array
        $sabores_array = array_map('trim', explode(",", $item['sabores'])); // Converte para array e remove espaços
        $adicionais = array_merge($adicionais, $sabores_array); // Adiciona os sabores como adicionais
    }

    // Converte o array de adicionais em uma string
    $adicionais_string = empty($adicionais) ? "Nenhum" : implode(", ", $adicionais);


    $query_pedido = "INSERT INTO pedido (id_pedido, numeropedido, nomeproduto, adicionais, pagamento, valortotal, responsavel, taxaentrega) 
                     VALUES (NULL, '$numero_pedido_id', '$nome_produto', '$adicionais_string', '$forma_pagamento', '$valor_total_float', '$nome_responsavel', '$taxa_entrega_float')";

    if (!mysqli_query($conn, $query_pedido)) {
        echo "Erro ao inserir pedido: " . mysqli_error($conn);
    }
}

// Limpe o carrinho após finalizar o pedido
unset($_SESSION['carrinho']);

echo "<script>alert('Pedido finalizado com sucesso!');location.href='venda.php';</script>";
