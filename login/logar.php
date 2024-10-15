<?php
session_start();

include '../conexao.php';
$nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
$senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

$sth = $pdo->prepare('SELECT * FROM pessoa WHERE nome_pessoa = :nome AND senha_pessoa = :senha');
$sth->bindValue(':nome', $nome);
$sth->bindValue(':senha', $senha);
$sth->execute();
if ($sth->rowCount() > 0) {
    $resultado = $sth->fetch(PDO::FETCH_ASSOC);
    extract($resultado);

    // Armazenar nome e ID da pessoa na sessão
    $_SESSION['boracai']['nome'] = $nome;
    $_SESSION['boracai']['id_pessoa'] = $id_pessoa;

    header('LOCATION: ../logado/geral.php');
} else {
    echo ("<script>alert('Email ou senha incorreta'); 
    location.href='../index.php';</script>");
}
?>
