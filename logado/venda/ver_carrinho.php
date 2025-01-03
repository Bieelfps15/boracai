<?php

$total_pedido = 0;

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "<div class='alert alert-info'>Nenhum item no pedido.</div>";
} else {
    echo "<h4 class='text-center my-4'>Pedido</h4>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-hover table-sm'>";
    echo "<thead class='thead-light'><tr><th>Produto</th><th>Tamanho/Sabor</th><th>Adicionais</th><th>Preço</th><th>Ações</th></tr></thead>";
    echo "<tbody>";

    foreach ($_SESSION['carrinho'] as $index => $item) {
        $item_total = $item['valor'];
        $total_pedido += $item_total; // soma ao total do pedido

        echo "<tr>";
        if (isset($item['tipo'])) {
            if ($item['tipo'] == 'açaí') {
                echo "<td>{$item['tipo']}</td>";
                echo "<td>{$item['tamanho']}</td>";
                echo "<td>" . (isset($item['adicionais']) && count($item['adicionais']) > 0 ? implode(", ", $item['adicionais']) : "Nenhum") . "</td>";
                echo "<td>R$ " . number_format($item['valor'], 2, ',', '.') . "</td>";
            } elseif ($item['tipo'] == 'bolo' || $item['tipo'] == 'torta' || $item['tipo'] == 'alfajor') {
                echo "<td>{$item['tipo']}</td>";
                echo "<td>" . (isset($item['sabor']) ? $item['sabor'] : 'N/A') . "</td>";
                echo "<td>N/A</td>";
                echo "<td>R$ " . number_format($item['valor'], 2, ',', '.') . "</td>";
            } elseif ($item['tipo'] == 'brigadeiro') {
                echo "<td>" . (isset($item['nome']) ? $item['nome'] : 'N/A') . "</td>";
                echo "<td>" . (isset($item['tamanho']) ? $item['tamanho'] : 'N/A') . "</td>";
                echo "<td>" . (isset($item['sabores']) ? $item['sabores'] : 'Nenhum') . "</td>";
                echo "<td>R$ " . number_format($item['valor'], 2, ',', '.') . "</td>";
            } elseif ($item['tipo'] == 'produto') {
                echo "<td>" . (isset($item['nome']) ? $item['nome'] : 'N/A') . "</td>";
                echo "<td>" . (isset($item['sabor']) ? $item['sabor'] : 'N/A') . "</td>";
                echo "<td>" . (isset($item['tamanho']) ? $item['tamanho'] . 'g' : 'N/A') . "</td>";
                echo "<td>R$ " . number_format($item['valor'], 2, ',', '.') . "</td>";
            }

        echo "<td>
            <form method='POST' action='remover_item.php' style='display:inline;'>
                <input type='hidden' name='index' value='$index'>
                <button type='submit'><i class='fas fa-trash' style='color: red;'></i></button>
            </form>
        </td>";

        echo "</tr>";
    }
}
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    echo "<h4 class='text-end'>Total: R$ " . number_format($total_pedido, 2, ',', '.') . "</h4>";

    echo "<h5 class='text-center my-4'>Escolha a Forma de Pagamento</h5>";
    echo "<form method='POST' action='finalizar_pedido.php' class='text-center my-4'>";
    echo "<select name='forma_pagamento' required class='form-select'>";
    echo "<option value='' disabled selected>Selecione uma forma de pagamento</option>";
    echo "<option value='Crédito'>Crédito</option>";
    echo "<option value='Débito'>Débito</option>";
    echo "<option value='Dinheiro'>Dinheiro</option>";
    echo "<option value='Pix'>Pix</option>";
    echo "<option value='Ifood'>Ifood</option>";
    echo "</select>";

    echo "<input type='hidden' name='valor_total' id='valor_total' value='" . number_format($total_pedido, 2, '.', '') . "'>";

    echo "<button type='button' class='btn btn-info mt-2 mb-2' id='toggleTaxa'>Adicionar Taxa de Entrega?</button>";

    echo "<br>";

    echo "<div class='form-group mt-2' id='taxaContainer' style='display: none;'>";
    echo "<label for='taxa_entrega'>Taxa de Entrega:</label>";
    echo "<input type='text' name='taxa_entrega' id='taxa_entrega' class='form-control' placeholder='Digite a taxa de entrega' 
        inputmode='numeric' pattern='[0-9]*(\.[0-9]{1,2}|,[0-9]{1,2})?' onKeyPress='return(moeda(this, \".\", \",\", event));' onInput='atualizarTotal()'>";
    echo "</div>";

    echo "<button type='submit' class='btn btn-success mt-2'>Finalizar Pedido</button>";
    echo "<h4 class='text-end'>Total do Pedido: <span id='exibir_valor_total'>R$ " . number_format($total_pedido, 2, ',', '.') . "</span></h4>";
    echo "</form>";
}
?>

<script>
    // habilitar o input da taxa de entrega
    document.getElementById('toggleTaxa').addEventListener('click', function() {
        var taxaContainer = document.getElementById('taxaContainer');
        taxaContainer.style.display = (taxaContainer.style.display === 'none') ? 'block' : 'none';
        atualizarTotal(); 
    });

    function atualizarTotal() {
        const taxaEntregaInput = document.getElementById('taxa_entrega').value;
        const taxaEntrega = parseFloat(taxaEntregaInput.replace(',', '.').replace(/[^\d.-]/g, '')) || 0;
        const valorTotalOriginal = <?php echo $total_pedido; ?>; 
        const totalComTaxa = valorTotalOriginal + taxaEntrega;

        document.getElementById('valor_total').value = totalComTaxa.toFixed(2).replace('.', ','); 
        document.getElementById('exibir_valor_total').innerText = "R$ " + totalComTaxa.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }); 
    }
</script>

<script language="javascript">
    function moeda(a, e, r, t) {
        let n = "",
            h = 0,
            u = 0,
            l = "",
            o = window.Event ? t.which : t.keyCode;

        if (o === 13 || o === 8) return true;

        n = String.fromCharCode(o);

        if (n < '0' || n > '9') return false;

        u = a.value.length;

        for (h = 0; h < u && (a.value.charAt(h) === '0' || a.value.charAt(h) === r); h++);

        l = "";
        for (; h < u; h++) {
            if ("0123456789".indexOf(a.value.charAt(h)) !== -1) {
                l += a.value.charAt(h);
            }
        }

        l += n;

        if (l.length === 0) {
            a.value = "";
        } else if (l.length === 1) {
            a.value = "0" + r + "0" + l;
        } else if (l.length === 2) {
            a.value = "0" + r + l;
        } else {
            let ajd2 = "";
            for (h = l.length - 3, j = 0; h >= 0; h--) {
                if (j === 3) {
                    ajd2 += e;
                    j = 0;
                }
                ajd2 += l.charAt(h);
                j++;
            }

            a.value = "";
            let tamanho2 = ajd2.length;
            for (h = tamanho2 - 1; h >= 0; h--) {
                a.value += ajd2.charAt(h);
            }
            a.value += r + l.substr(l.length - 2, 2);
        }

        atualizarTotal();

        return false;
    }
</script>