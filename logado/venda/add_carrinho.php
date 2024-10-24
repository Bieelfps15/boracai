<?php
include '../../conexao.php';
session_start(); 

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
            'nome' => 'Açaí',
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
            'nome' => 'Bolo',
            'tipo' => 'bolo',
            'sabor' => $sabor_bolo,
            'valor' => $valor_bolo
        ];
    } elseif ($_POST['acao'] == 'adicionar_torta') {
        $sabor_torta = $_POST['torta'];
        $valor_torta = floatval(explode(" - R$", $sabor_torta)[1]);

        // Adiciona a torta ao carrinho
        $_SESSION['carrinho'][] = [
            'nome' => 'Torta',
            'tipo' => 'torta',
            'sabor' => $sabor_torta,
            'valor' => $valor_torta
        ];
    } elseif ($_POST['acao'] == 'adicionar_alfajor') {
        $sabor_alfajor = $_POST['alfajor'];
        $valor_alfajor = floatval(explode(" - R$", $sabor_alfajor)[1]);

        // Adiciona a torta ao carrinho
        $_SESSION['carrinho'][] = [
            'nome' => 'Alfajor',
            'tipo' => 'alfajor',
            'sabor' => $sabor_alfajor,
            'valor' => $valor_alfajor
        ];
    } elseif ($_POST['acao'] == 'adicionar_brigadeiro') {
        $tamanhobrigadeiro = $_POST['tamanho_brigadeiro'] ?? '';
        $saboresSelecionados = [];

        for ($i = 1; $i <= 4; $i++) {
            if (isset($_POST["sabor_$i"])) {
                $saboresSelecionados[] = $_POST["sabor_$i"];
            }
        }

        if (strpos($tamanhobrigadeiro, " - R$ ") !== false) {
            $valor_brigadeiro = floatval(explode(" - R$ ", $tamanhobrigadeiro)[1]);
            $tamanho_brigadeiro = explode(" - R$ ", $tamanhobrigadeiro)[0];

            $saboresString = implode(", ", $saboresSelecionados);

            $_SESSION['carrinho'][] = [
                'nome' => 'Brigadeiro',
                'tipo' => 'brigadeiro',
                'tamanho' => $tamanho_brigadeiro,
                'sabores' => $saboresString,
                'valor' => $valor_brigadeiro
            ];
        } else {
            echo "Erro: Formato de tamanho não reconhecido.";
        }
    }elseif ($_POST['acao'] == 'adicionar_produto') {
        $produtos = json_decode($_POST['produtos'], true);

    if ($produtos) {
        $_SESSION['carrinho'][] = [
            'tipo' =>'produto',
            'nome' => $produtos['nome_produto'],
            'sabor' => $produtos['sabor2'],
            'tamanho' => $produtos['tamanho'],
            'valor' => floatval($produtos['valor'])
        ];
    }
}
}
header("Location: venda.php");
exit();

?>