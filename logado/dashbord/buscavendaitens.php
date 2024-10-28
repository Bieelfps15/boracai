<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "boracai");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$nome_itens = $_GET['nome'];

// Buscar quantidade de vendas por nome de produto
$sql = "SELECT nomeproduto, COUNT(*) as vendas FROM pedido WHERE nomeproduto LIKE CONCAT('%', ?, '%') GROUP BY nomeproduto";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome_itens);
$stmt->execute();
$result = $stmt->get_result();

$data = [
    'labels' => [],
    'values' => []
];

while ($row = $result->fetch_assoc()) {
    $data['labels'][] = $row['nomeproduto'];
    $data['values'][] = $row['vendas'];
}

echo json_encode($data);

$conn->close();
?>