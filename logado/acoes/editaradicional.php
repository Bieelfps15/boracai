<?php

include '../../conexao.php';

$id_adicional = filter_input(INPUT_POST, 'id_adicional', FILTER_DEFAULT);
$novo_valor = str_replace(",", ".", str_replace(".", "", $_POST['valor_adicional'])); 

$sth = $pdo->prepare("UPDATE adicionais SET valor_adicional = :valor_adicional WHERE id_adicional = :id_adicional");
$sth->bindValue(":valor_adicional", $novo_valor, PDO::PARAM_STR);
$sth->bindValue(":id_adicional", $id_adicional, PDO::PARAM_INT);

$sth->execute();


header("LOCATION:../itens.php");
