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

document.getElementById('togglePassword1').addEventListener('click', function () {
 const senhaInput = document.getElementById('resenha');
 const eyeIcon = document.getElementById('eyeIcon1');
 
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

$(document).ready(function () {
    $('#submit').click(function (event) {
        var senha = $('#senha').val();
        var resenha = $('#resenha').val();
        
        if (senha !== resenha) {
            alert('As senhas não são iguais. Por favor, tente novamente.');
            event.preventDefault(); // Impede o envio do formulário
        }
    });
});