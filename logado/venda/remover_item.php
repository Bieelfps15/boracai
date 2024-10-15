<?php
session_start();

// Verifica se o carrinho existe e se o índice é válido
if (isset($_SESSION['carrinho']) && isset($_POST['index'])) {
    $index = intval($_POST['index']);
    
    // Verifica se o índice está dentro dos limites do array
    if (array_key_exists($index, $_SESSION['carrinho'])) {
        unset($_SESSION['carrinho'][$index]); 
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); 
    }
}


header("Location: venda.php");
exit();
?>
