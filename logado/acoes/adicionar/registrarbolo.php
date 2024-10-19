<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=boracai", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}

if (isset($_POST['action'])) {
    $sabor = mb_strtoupper(mb_substr(trim($_POST['sabor']), 0, 1), 'UTF-8') . mb_strtolower(mb_substr(trim($_POST['sabor']), 1), 'UTF-8');
    $valor = str_replace(",", ".", str_replace(".", "", $_POST['valor'])); 

    if (!empty($sabor) && !empty($valor)) {
        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO saborbolo (sabor_bolo) VALUES (:sabor)");
            $stmt->bindParam(':sabor', $sabor);
            $stmt->execute();

            $saborId = $pdo->lastInsertId();

            $stmt = $pdo->prepare("INSERT INTO produto (nome_produto, sabor, sabor2, tamanho, valor, status) VALUES (2, :saborId, 0, 0, :valor, 0)");
            $stmt->bindParam(':saborId', $saborId);
            $stmt->bindParam(':valor', $valor);
            $stmt->execute();

            $pdo->commit();

            header("Location: ../../itens.php?msg=Bolo adicionado com sucesso!");
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            die("Erro ao adicionar o bolo: " . $e->getMessage());
        }
    } else {
        header("Location: ../../itens.php?msg=Preencha todos os campos!");
        exit();
    }
}

$pdo = null;
?>