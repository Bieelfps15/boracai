<?php
    include '../../../conexao.php'; 

    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $sabor = $_POST['sabores'];
    $novo_sabor = $_POST['novo_sabor'];
    $status = 0;
    $tamanho = 0;
    $nome = 3;
    $valorConvertido = str_replace(',', '.', str_replace('.', '', $post['valor']));

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
        'nome_produto' => $nome,
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

    header("Location: ../../itens.php?msg=Produto adicionado com sucesso!&aba=menu4");
?>