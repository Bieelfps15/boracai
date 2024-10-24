<?php

include '../conexao.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
$hash = password_hash($senha, PASSWORD_BCRYPT);

$Dados = array(
    'nome_pessoa' => $post['nome'],
    'senha_pessoa' => $hash
);

$Fields = implode(', ', array_keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'pessoa';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";

$sth = $pdo->prepare($Create);
$sth->execute($Dados);

echo ("<script>alert('Cadastrado com sucesso'); 
    location.href='../index.php';</script>");
?>