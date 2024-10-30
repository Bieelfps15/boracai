<?php
session_start();

if (isset($_SESSION['carrinho']) && isset($_POST['index'])) {
    $index = intval($_POST['index']);
    
    if (array_key_exists($index, $_SESSION['carrinho'])) {
        unset($_SESSION['carrinho'][$index]); 
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); 
    }
}


header("Location: venda.php");
exit();
?>
