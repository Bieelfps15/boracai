  
    // seleciona o modal do acai pelo id
    var acaiModal = document.getElementById('modal1');

    acaiModal.addEventListener('hidden.bs.modal', function() {
        // limpar ao fechar o modal
        acaiModal.addEventListener('hidden.bs.modal', function() {
            limparCheckboxes(acaiModal);
        });

        function adicionarAoCarrinho() {
            console.log("Item adicionado ao carrinho!");
            limparCheckboxes(acaiModal);
        }

        // função para desmarcar os checkboxes no modal do acai
        function limparCheckboxes(modal) {
            var checkboxes = modal.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
        // desmarca todos os checkboxes dentro do modal
        var checkboxes = acaiModal.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
    });

    var brigadeiroModal = document.getElementById('modal6');
    brigadeiroModal.addEventListener('hidden.bs.modal', function() {
        brigadeiroModal.addEventListener('hidden.bs.modal', function() {
            limparRadios(brigadeiroModal);
        });

        function adicionarAoCarrinho() {
            console.log("Item adicionado ao carrinho!");
            limparRadios(brigadeiroModal);
        }

        function limparRadios(modal) {
            var radios = modal.querySelectorAll('input[type="radio"]');
            radios.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
        var radios = brigadeiroModal.querySelectorAll('input[type="radio"]');
        radios.forEach(function(checkbox) {
            checkbox.checked = false;
        });
    });