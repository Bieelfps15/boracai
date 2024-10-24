<?php

include '../../../conexao.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$nomeSabor = mb_strtoupper(mb_substr(trim($post['nome_sabor']), 0, 1), 'UTF-8') . mb_strtolower(mb_substr(trim($post['nome_sabor']), 1), 'UTF-8');
$status = 0;

$Dados = array(
    'nome_sabor' => $nomeSabor,
    'statusgeral' => $status 
);

$Fields = implode(', ', array_keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'saborgeral';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";

$sth = $pdo->prepare($Create);
$sth->execute($Dados);
echo $pdo->lastInsertId();

header("Location: ../../itens.php?&aba=menu7");


?>