<?php

include '../../../conexao.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$status = 0;

$Dados = array(
    'nome_brigadeiro' => $post['nome_brigadeiro'],
    'statusbrigadeiro' => $status 
);

$Fields = implode(', ', array_keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'brigadeiro';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";

$sth = $pdo->prepare($Create);
$sth->execute($Dados);
echo $pdo->lastInsertId();

header("LOCATION: ../../itens.php");


?>