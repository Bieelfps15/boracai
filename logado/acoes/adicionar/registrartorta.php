<?php
    include '../../../conexao.php'; 

    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $sabor = $_POST['sabores'];
    $novo_sabor = $_POST['novo_sabor'];
    $status = 0;

    if ($sabor === 'outrosabor' && !empty($novo_sabor)) {
        $sabor = $novo_sabor;
        $status = 0;
        $sth = $pdo->prepare("INSERT INTO saborgeral (nome_sabor, statusgeral) VALUES (:nome_sabor, :statusgeral)");
        $sth->bindParam(':nome_sabor', $sabor);
        $sth->bindParam(':statusgeral', $status);
        $sth->execute();

        $sabor_id = $pdo->lastInsertId();
    } else {
        $sabor_id = $sabor;
    }

    $tamanho = 0;
    $nome = 3;
    $valorConvertido = str_replace(',', '.', str_replace('.', '', $post['valor']));
    $sabor = 0;

    $sth = $pdo->prepare("INSERT INTO produto (nome_produto, sabor, sabor2, tamanho, valor, status) VALUES (:nome_produto, :sabor, :sabor2, :tamanho, :valor, :status)");
    $sth->bindParam(':nome_produto', $nome);
    $sth->bindParam(':sabor', $sabor);
    $sth->bindParam(':sabor2', $sabor_id);
    $sth->bindParam(':tamanho', $tamanho);
    $sth->bindParam(':valor', $valorConvertido);
    $sth->bindParam(':status', $status);
    $sth->execute();

    header("Location: ../../itens.php?msg=Produto adicionado com sucesso!&aba=menu4");
?>