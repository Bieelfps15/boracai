<?php

include '../../../conexao.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$nomeBrigadeiro = mb_strtoupper(mb_substr(trim($post['nome_brigadeiro']), 0, 1), 'UTF-8') . mb_strtolower(mb_substr(trim($post['nome_brigadeiro']), 1), 'UTF-8');
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
echo $pdo->lastInsertId();

header("Location: ../../itens.php?&aba=menu6");


?>