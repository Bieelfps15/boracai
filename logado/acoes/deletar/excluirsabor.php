<?php

include '../../../conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$sth = $pdo->prepare("UPDATE saborgeral set statusgeral = 1 where id_geral = :id");
$sth->bindValue(":id", $id, PDO::PARAM_INT);
$sth->execute();
header("LOCATION: ../../itens.php?&aba=menu7");
?>