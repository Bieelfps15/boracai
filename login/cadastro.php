<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="icon" type="imagem/png" href="../img/boraçai.png" />
    <link rel="stylesheet" type="text/css" href="../css/cadastro.css">
    <title>Cadastro</title>
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="card_login">
                <div class="d-flex justify-content-center">
                    <div class="logo_login">
                        <img src="../img/IMG_2180.PNG" class="logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">

                    <form name="form1" action="insertcadastro.php" method="post">
                        <header style="text-align: center;color: black;padding: 1rem;">
                            <h2>Cadastro de usuario</h2>
                        </header>
                        <div class="input-group mb-4">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user" style="width:13px; "></i></span>
                            </div>
                            <input type="text" name="nome" class="form-control input_user" placeholder="Nome de usuario" required>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-key" style="width:13px;"></i>
                                </span>
                            </div>
                            <input type="password" id="senha" name="senha" class="form-control input_pass" placeholder="Senha" required>
                            <div class="input-group-append">
                                <button type="button" id="togglePassword" class="btn" style="background-color: #a53893; color: #fff;">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-key" style="width:13px;"></i>
                                </span>
                            </div>
                            <input type="password" id="resenha" name="resenha" class="form-control input_pass" placeholder="Confirme a senha" required>
                            <div class="input-group-append">
                                <button type="button" id="togglePassword1" class="btn" style="background-color: #a53893; color: #fff;">
                                    <i class="fas fa-eye" id="eyeIcon1"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" name="submit" id="submit" class="btn login_btn form-btn">Cadastrar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/login.js"></script>

</body>



</html>