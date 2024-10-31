<?php

include '../../../conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$sth = $pdo->prepare("UPDATE brigadeiro set statusbrigadeiro = 1 where id_brigadeiro = :id");
$sth->bindValue(":id", $id, PDO::PARAM_INT);
$sth->execute();
header("LOCATION: ../../itens.php?&aba=menu6");
?>