   //index

   document.getElementById('togglePassword').addEventListener('click', function () {
    const senhaInput = document.getElementById('senha');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (senhaInput.type === 'password') {
        senhaInput.type = 'text';
        eyeIcon.classList.remove('fa-eye'); // Troca para ícone "ocultar"
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        senhaInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash'); // Troca para ícone "mostrar"
        eyeIcon.classList.add('fa-eye');
    }
});



//
   
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
            return false;
        }


    //itens.php
        document.addEventListener('DOMContentLoaded', function() {

            let filters = document.querySelectorAll('.filter-input');
            filters.forEach(input => {
                input.addEventListener('keyup', function() {
                    filterTable(input.id, `tabela${input.id.replace('filter', '')}`);
                });
            });

        });
        // Função de filtro
        function filterTable(inputId, tableId) {
            let input = document.getElementById(inputId);
            let filter = input.value.toLowerCase();
            let table = document.getElementById(tableId);
            let tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        if (td[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                            match = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = match ? "" : "none";
            }
        }


//venda.php
        var modal1 = document.getElementById('modal1');
    var inputModal1 = document.getElementById('inputModal1');

    modal1.addEventListener('shown.bs.modal', function() {
        inputModal1.focus();
    });
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









    //