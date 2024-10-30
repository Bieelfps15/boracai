<?php
    include '../../../conexao.php'; 

    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $tipo_produto = $_POST['tipo_produto'];
    $novo_tipo_produto = $_POST['novo_tipo_produto'];
    $sabor = $_POST['sabor'];
    $novo_sabor = $_POST['novo_sabor'];
    $tamanho = $_POST['tamanho'] ?? null;
    $status = 0;
    $valorConvertido = str_replace(',', '.', str_replace('.', '', $post['valor']));

    if ($tipo_produto === 'outro' && !empty($novo_tipo_produto)) {
        $tipo_produto = ucfirst(strtolower($novo_tipo_produto));

        $Dados = array(
            'nome_itens' => $tipo_produto
        );
        
        $Fields = implode(', ', array_keys($Dados));
        $Places = ':' . implode(', :', array_keys($Dados));
        $Tabela = 'itens';
        $Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";
        $sth = $pdo->prepare($Create);
        $sth->execute($Dados);

        $tipo_produto_id = $pdo->lastInsertId();
    } else {
        $tipo_produto_id = $tipo_produto;
    }

    if ($sabor === 'outrosabor' && !empty($novo_sabor)) {
        $sabor = ucfirst(strtolower($novo_sabor));

        $Dados = array(
            'nome_sabor' => $sabor,
            'statusgeral' => $status 
        );
        
        $Fields = implode(', ', array_keys($Dados));
        $Places = ':' . implode(', :', array_keys($Dados));
        $Tabela = 'saborgeral';
        $Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";
        $sth = $pdo->prepare($Create);
        $sth->execute($Dados);

        $sabor_id = $pdo->lastInsertId();
    } else {
        $sabor_id = $sabor;
    }

    $Dados = array(
        'nome_produto' => $tipo_produto_id,
        'sabor' => $sabor_id,
        'tamanho' => $tamanho,
        'valor' => $valorConvertido,
        'status' => $status 
    );
    
    $Fields = implode(', ', array_keys($Dados));
    $Places = ':' . implode(', :', array_keys($Dados));
    $Tabela = 'produto';
    $Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";
    $sth = $pdo->prepare($Create);
    $sth->execute($Dados);


    header("Location: ../../itens.php?&aba=menu8");
?>