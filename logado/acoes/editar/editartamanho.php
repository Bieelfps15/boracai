<?php

include '../../../conexao.php';

$id_produto = filter_input(INPUT_POST, 'id_produto', FILTER_SANITIZE_NUMBER_INT);
$novo_valor = str_replace(",", ".", str_replace(".", "", $_POST['novo_valor']));

$sth = $pdo->prepare("UPDATE produto SET valor = :valor WHERE id_produto = :id_produto");
$sth->bindValue(":valor", $novo_valor, PDO::PARAM_STR);
$sth->bindValue(":id_produto", $id_produto, PDO::PARAM_INT);

$sth->execute();
header("LOCATION: ../../itens.php");
