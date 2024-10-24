<?php
session_start();

include '../conexao.php';

$nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
$senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

$sth = $pdo->prepare('SELECT * FROM pessoa WHERE nome_pessoa = :nome');
$sth->bindValue(':nome', $nome);
$sth->execute();

$resultado = $sth->fetch(PDO::FETCH_ASSOC);

if ($resultado && password_verify($senha, $resultado['senha_pessoa'])) {
    $_SESSION['boracai']['nome'] = $resultado['nome_pessoa'];
    $_SESSION['boracai']['id_pessoa'] = $resultado['id_pessoa'];

    header('LOCATION: ../logado/geral.php');
} else {
    echo ("<script>alert('Nome ou senha incorretos'); 
    location.href='../index.php';</script>");
}
?>
