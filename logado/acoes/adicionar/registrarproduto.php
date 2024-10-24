<?php
    include '../../../conexao.php'; 

    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // Verifique se foi selecionado um tipo do select ou inserido um novo tipo
    $tipo_produto = $_POST['tipo_produto'];
    $novo_tipo_produto = $_POST['novo_tipo_produto'];

    if ($tipo_produto === 'outro' && !empty($novo_tipo_produto)) {
        // Se o usuário escolheu "outro" e digitou um novo tipo, use o novo tipo
        $tipo_produto = $novo_tipo_produto;

        // Opcional: Salvar o novo tipo no banco de dados, se desejar que ele apareça no select no futuro
        $sth = $pdo->prepare("INSERT INTO itens (nome_itens) VALUES (:nome_itens)");
        $sth->bindParam(':nome_itens', $tipo_produto);
        $sth->execute();

        // Pegue o ID do novo tipo inserido para usar adiante
        $tipo_produto_id = $pdo->lastInsertId();
    } else {
        // Use o ID do tipo selecionado no select
        $tipo_produto_id = $tipo_produto;
    }

    $sabor2 = $_POST['sabor'] ?? null;
    $tamanho = $_POST['tamanho'] ?? null;
    $status = 0;
    $valorConvertido = str_replace(',', '.', str_replace('.', '', $post['valor']));
    $sabor = 0;

    $sth = $pdo->prepare("INSERT INTO produto (nome_produto, sabor, sabor2, tamanho, valor, status) VALUES (:nome_produto, :sabor, :sabor2, :tamanho, :valor, :status)");
    $sth->bindParam(':nome_produto', $tipo_produto_id);
    $sth->bindParam(':sabor', $sabor);
    $sth->bindParam(':sabor2', $sabor2);
    $sth->bindParam(':tamanho', $tamanho);
    $sth->bindParam(':valor', $valorConvertido);
    $sth->bindParam(':status', $status);
    $sth->execute();

    header("Location: ../../itens.php?msg=Produto adicionado com sucesso!");
?>