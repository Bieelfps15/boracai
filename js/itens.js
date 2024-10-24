document.getElementById('tipoProduto').addEventListener('change', function() {
    var novoTipo = document.getElementById('novoTipoProduto');
    if (this.value === 'outro') {
        novoTipo.style.display = 'block';
    } else {
        novoTipo.style.display = 'none';
    }
});

document.getElementById('btnAdicionarSabor').addEventListener('click', function() {
    var saborInput = document.getElementById('saborInput');
    saborInput.style.display = saborInput.style.display === 'none' ? 'block' : 'none';
});

document.getElementById('btnAdicionarTamanho').addEventListener('click', function() {
    var tamanhoInput = document.getElementById('tamanhoInput');
    tamanhoInput.style.display = tamanhoInput.style.display === 'none' ? 'block' : 'none';
});