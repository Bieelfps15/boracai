<?php

$pdo = new PDO("mysql:host=localhost;dbname=boracai", "root", "");

$sql = "SELECT t.tamanho AS Tamanho, COUNT(*) AS Quantidade
        FROM pedido p
        JOIN produto t ON p.nomeproduto LIKE CONCAT('%', t.tamanho, '%')
        WHERE t.tamanho <> '' and t.tamanho >299
        GROUP BY t.tamanho;";

$sth = $pdo->prepare($sql);
$sth->execute();

$tamanhos = [];
$quantidades1 = [];

foreach ($sth as $row) {
    $tamanhos[] = $row['Tamanho'];
    $quantidades1[] = $row['Quantidade'];
}

$sql = "SELECT 
            DATE_FORMAT(date_range.date, '%d/%m/%Y') AS data_venda,
            COALESCE(SUM(DISTINCT p.valortotal), 0) AS total_vendas
        FROM 
            (SELECT CURDATE() - INTERVAL (n.n) DAY AS date
             FROM (SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6) AS n) AS date_range
        LEFT JOIN 
            numeropedido n ON DATE(n.data) = date_range.date
        LEFT JOIN 
            pedido p ON p.numeropedido = n.id
        WHERE 
            date_range.date >= CURDATE() - INTERVAL 6 DAY
        GROUP BY 
            date_range.date
        ORDER BY 
            date_range.date DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$datas = [];
$vendas = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $datas[] = $row['data_venda'];
    $vendas[] = (float) $row['total_vendas'];
}

$sql_bolo = "SELECT 
    TRIM(REPLACE(REPLACE(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nomeproduto, ' - ', -1), 'R$', 1), 'Bolo de ', ''), 'bolo de ', '')) AS Sabor,
    COUNT(*) AS Quantidade
FROM 
    pedido p
WHERE 
    p.nomeproduto LIKE 'bolo%'
    AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nomeproduto, ' - ', -1), 'R$', 1)) <> ''
    AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nomeproduto, ' - ', -1), 'R$', 1)) NOT REGEXP '^[0-9]+$'
GROUP BY 
    Sabor
ORDER BY 
    Sabor";

$sth_bolo = $pdo->prepare($sql_bolo);
$sth_bolo->execute();

$sabores_bolo = [];
$quantidades_bolo = [];

foreach ($sth_bolo as $row) {
    $sabores_bolo[] = $row['Sabor'];
    $quantidades_bolo[] = $row['Quantidade'];
}

$sql_adicional = "SELECT 
    TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(pd.adicionais, ',', numbers.n), ',', -1)) AS Adicional,
    COUNT(*) AS Quantidade_Adicional
FROM 
    pedido pd
JOIN 
    (
        SELECT 
            1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 
            UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
            UNION ALL SELECT 9 UNION ALL SELECT 10
    ) numbers ON CHAR_LENGTH(pd.adicionais) - CHAR_LENGTH(REPLACE(pd.adicionais, ',', '')) >= numbers.n - 1
WHERE 
    pd.nomeproduto LIKE '%açai%'  
    AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(pd.adicionais, ',', numbers.n), ',', -1)) <> 'Nenhum'
    AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(pd.adicionais, ',', numbers.n), ',', -1)) <> ''
GROUP BY 
    Adicional
ORDER BY 
    Adicional;";

$sth_adicional = $pdo->prepare($sql_adicional);
$sth_adicional->execute();

$adicionais = [];
$quantidades_adicionais = [];

foreach ($sth_adicional as $row) {
    $adicionais[] = $row['Adicional'];
    $quantidades_adicionais[] = $row['Quantidade_Adicional'];
}



$sql_torta = "SELECT 
    TRIM(REPLACE(REPLACE(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nomeproduto, ' - ', -1), 'R$', 1), 'Torta de ', ''), 'torta de ', '')) AS Sabor,
    COUNT(*) AS Quantidade
FROM 
    pedido p
WHERE 
    p.nomeproduto LIKE 'torta%'
    AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nomeproduto, ' - ', -1), 'R$', 1)) <> ''
    AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nomeproduto, ' - ', -1), 'R$', 1)) NOT REGEXP '^[0-9]+$'
GROUP BY 
    Sabor
ORDER BY 
    Sabor";

$sth_torta = $pdo->prepare($sql_torta);
$sth_torta->execute();

$sabores_torta = [];
$quantidades_torta = [];

foreach ($sth_torta as $row) {
    $sabores_torta[] = $row['Sabor'];
    $quantidades_torta[] = $row['Quantidade'];
}

$sql_alfajor = "SELECT 
    TRIM(REPLACE(REPLACE(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nomeproduto, ' - ', -1), 'R$', 1), 'Alfajor de ', ''), 'alfajor de ', '')) AS Sabor,
    COUNT(*) AS Quantidade
FROM 
    pedido p
WHERE 
    p.nomeproduto LIKE 'alfajor%'
    AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nomeproduto, ' - ', -1), 'R$', 1)) <> ''
    AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nomeproduto, ' - ', -1), 'R$', 1)) NOT REGEXP '^[0-9]+$'
GROUP BY 
    Sabor
ORDER BY 
    Sabor";

$sth_alfajor = $pdo->prepare($sql_alfajor);
$sth_alfajor->execute();

$sabores_alfajor = [];
$quantidades_alfajor = [];

foreach ($sth_alfajor as $row) {
    $sabores_alfajor[] = $row['Sabor'];
    $quantidades_alfajor[] = $row['Quantidade'];
}


$sql = "SELECT 
    combinacao_adicional,
    COUNT(*) AS quantidade
FROM (
    SELECT 
        p.id_pedido,
        GROUP_CONCAT(TRIM(a.adicional) ORDER BY a.adicional SEPARATOR ', ') AS combinacao_adicional
    FROM 
        pedido p
    JOIN 
        (SELECT 
            id_pedido, 
            TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(adicionais, ',', n.n), ',', -1)) AS adicional
        FROM 
            pedido 
        JOIN 
            (SELECT 1 AS n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10) n
        ON 
            CHAR_LENGTH(adicionais) - CHAR_LENGTH(REPLACE(adicionais, ',', '')) >= n.n - 1) a ON p.id_pedido = a.id_pedido
    WHERE 
        p.nomeproduto LIKE '%brigadeiro%'
    GROUP BY 
        p.id_pedido
) AS subquery
GROUP BY 
    combinacao_adicional
    HAVING 
    combinacao_adicional <> 'nenhum'
ORDER BY 
    quantidade DESC";

$sth = $pdo->prepare($sql);
$sth->execute();
$resultados = $sth->fetchAll(PDO::FETCH_ASSOC);

$combinacoes = [];
$quantidades = [];

foreach ($resultados as $resultado) {
    $combinacoes[] = $resultado['combinacao_adicional'];
    $quantidades[] = $resultado['quantidade'];
}


$pdo = null;
