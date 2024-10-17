<?php

include '../../../conexao.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$nome = 4;
$valorConvertido = str_replace(',', '.', str_replace('.', '', $post['valor']));
$status = 0;
$sabor = 0;
$tamanho = 0;

$Dados = array(
    'nome_produto' => $nome,
    'sabor' => $sabor,
    'sabor2' => $post['sabores'],
    'tamanho' => $tamanho,
    'valor' => $valorConvertido,
    'status' => $status 
);

$Fields = implode(', ', array_keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'produto';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";

$sth = $pdo->prepare($Create);
$sth->execute($Dados);
echo $pdo->lastInsertId();

header("LOCATION: ../../itens.php");


?>