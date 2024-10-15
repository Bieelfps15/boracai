<?php

$query = "SELECT 
        p.numeropedido,
        GROUP_CONCAT(
            CASE 
                WHEN p.nomeproduto REGEXP '^[0-9]+$' THEN CONCAT(p.nomeproduto, ' ml') 
                ELSE p.nomeproduto 
            END SEPARATOR ', ') AS produtos_vendidos,
        GROUP_CONCAT(
            CASE 
                WHEN p.adicionais != 'Nenhum' THEN p.adicionais 
                ELSE NULL 
            END SEPARATOR ' | ') AS adicionais, p.pagamento, p.valortotal, p.taxaentrega, p.responsavel FROM pedido p GROUP BY p.numeropedido ORDER BY p.numeropedido DESC";

$sth = $pdo->prepare($query);
$sth->execute();
$pedidos = $sth->fetchAll(PDO::FETCH_ASSOC);

?>