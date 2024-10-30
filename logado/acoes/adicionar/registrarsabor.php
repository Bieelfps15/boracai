<?php

include '../../../conexao.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$nomeSabor = ucfirst(strtolower($_POST['nome_sabor']));
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

header("Location: ../../itens.php?&aba=menu7");


?>