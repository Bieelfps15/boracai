<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "boracai");

$nome_itens = $_GET['nome'];

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