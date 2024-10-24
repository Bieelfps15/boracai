document.getElementById('sabores').addEventListener('change', function() {
    var novosabor = document.getElementById('novosabortorta');
    if (this.value === 'outrosabor') {
        novosabor.style.display = 'block';
    } else {
        novosabor.style.display = 'none';
    }
});

document.getElementById('sabores1').addEventListener('change', function() {
    var novosabor = document.getElementById('novosaboralfajor');
    if (this.value === 'outrosabor') {
        novosabor.style.display = 'block';
    } else {
        novosabor.style.display = 'none';
    }
});

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


document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const aba = urlParams.get('aba');
    
    if (aba) {
        const menuTab = document.querySelector(`#${aba}-tab`);
        if (menuTab) {
            // Remove a classe 'active' de todas as abas e conteúdo
            document.querySelectorAll('.nav-link').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active', 'show'));
            
            // Ativa a aba e o conteúdo específico
            menuTab.classList.add('active');
            const tabContent = document.querySelector(`#${aba}`);
            if (tabContent) {
                tabContent.classList.add('active', 'show');
            }
        }
    }
});