<?php
$conn = new mysqli("localhost", "root", "", "boracai");

$sql = "SELECT id_itens, nome_itens FROM itens WHERE id_itens > 5";
$result = $conn->query($sql);

$itens = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $itens[] = [
            'id' => $row['id_itens'],
            'nome' => $row['nome_itens']
        ];
    }
}

echo json_encode($itens);

$conn->close();
?>
