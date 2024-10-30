<?php

include '../../../conexao.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$nomeAdicional = ucfirst(mb_strtolower(trim($_POST['nome_adicional'])));
$valorConvertido = str_replace(',', '.', str_replace('.', '', $post['valor_adicional']));
$status = 0;

$Dados = array(
    'nome_adicional' => $nomeAdicional,
    'valor_adicional' => $valorConvertido,
    'status_adicional' => $status 
);

$Fields = implode(', ', array_keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'adicionais';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";

$sth = $pdo->prepare($Create);
$sth->execute($Dados);

header("Location: ../../itens.php?&aba=menu2");


?>