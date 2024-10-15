<?php

include '../../conexao.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$valorConvertido = str_replace(',', '.', str_replace('.', '', $post['valor_adicional']));
$status = 0;

$Dados = array(
    'nome_adicional' => $post['nome_adicional'],
    'valor_adicional' => $valorConvertido,
    'status_adicional' => $status 
);

$Fields = implode(', ', array_keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'adicionais';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";

$sth = $pdo->prepare($Create);
$sth->execute($Dados);
echo $pdo->lastInsertId();

header("LOCATION: ../itens.php");


?>