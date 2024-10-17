<?php

include '../../../conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$sth = $pdo->prepare("UPDATE adicionais set status_adicional = 1 where id_adicional = :id");
$sth->bindValue(":id", $id, PDO::PARAM_INT);
$sth->execute();
header("LOCATION: ../../itens.php");
?>