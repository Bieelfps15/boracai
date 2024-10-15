<?php
include '../../conexao.php';
session_start(); // Certifique-se de que a sessão é iniciada corretamente

// Verifica se o usuário está logado
if (!isset($_SESSION['boracai'])) {
    header("Location: ../../index.php");
    die;
}

// Inicializa um array para armazenar os itens do carrinho se não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Verifica o método POST e a ação do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao'])) {
    if ($_POST['acao'] == 'adicionar_acai') {
        // Obtem o tamanho e o valor do açaí
        $tamanho_acai = $_POST['tamanho_acai'];
        $valor_acai = floatval(explode(" - R$", $tamanho_acai)[1]);
        $adicionais = isset($_POST['adicionais']) ? $_POST['adicionais'] : [];

        // Inicializa o valor total do açaí
        $valor_total_acai = $valor_acai;

        // Calcula o valor total considerando os adicionais
        foreach ($adicionais as $adicional) {
            $valor_adicional = floatval(explode(" - R$", $adicional)[1]);
            $valor_total_acai += $valor_adicional; // Soma o valor do adicional
        }

        // Adiciona o açaí ao carrinho
        $_SESSION['carrinho'][] = [
            'tipo' => 'açaí',
            'tamanho' => $tamanho_acai,
            'adicionais' => $adicionais,
            'valor' => $valor_total_acai
        ];

    } elseif ($_POST['acao'] == 'adicionar_bolo') {
        $sabor_bolo = $_POST['sabor_bolo'];
        $valor_bolo = floatval(explode(" - R$", $sabor_bolo)[1]);

        // Adiciona o bolo ao carrinho
        $_SESSION['carrinho'][] = [
            'tipo' => 'bolo',
            'sabor' => $sabor_bolo,
            'valor' => $valor_bolo
        ];
    }
}

header("Location: venda.php");
exit();
?>
