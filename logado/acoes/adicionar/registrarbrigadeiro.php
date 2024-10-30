<?php

include '../../../conexao.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$nomeBrigadeiro = ucfirst(strtolower($_POST['nome_brigadeiro']));
$status = 0;

$Dados = array(
    'nome_brigadeiro' => $nomeBrigadeiro,
    'statusbrigadeiro' => $status 
);

$Fields = implode(', ', array_keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'brigadeiro';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";

$sth = $pdo->prepare($Create);
$sth->execute($Dados);

header("Location: ../../itens.php?&aba=menu6");


?>