  
    // Seleciona o modal do Açaí pelo ID
    var acaiModal = document.getElementById('modal1');
    // Adiciona um evento que será executado ao fechar o modal
    acaiModal.addEventListener('hidden.bs.modal', function() {
        // Limpar checkboxes ao fechar o modal
        acaiModal.addEventListener('hidden.bs.modal', function() {
            limparCheckboxes(acaiModal);
        });

        // Função para adicionar o item ao carrinho e limpar os checkboxes
        function adicionarAoCarrinho() {
            // Lógica para adicionar o item ao carrinho (aqui você implementa a adição)
            console.log("Item adicionado ao carrinho!");

            // Limpa os checkboxes após adicionar ao carrinho
            limparCheckboxes(acaiModal);
        }

        // Função para desmarcar os checkboxes no modal do Açaí
        function limparCheckboxes(modal) {
            var checkboxes = modal.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
        // Desmarca todos os checkboxes dentro do modal
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