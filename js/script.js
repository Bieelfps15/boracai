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

     









    //