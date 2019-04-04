<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="/login" method="POST">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="user" name="user" class="form-control" placeholder="Usuário"
                                required="required" autofocus="autofocus">
                            <label for="user">Usuário</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Senha" required="required">
                            <label for="password">Senha</label>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                            <label for="remember" class="custom-control-label">Lembrar senha</label>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </form>
                <div class="text-center">
                    <!-- <a class="d-block small mt-3" href="register.html">Register an Account</a> -->
                    <a class="d-block small mt-3" href="/forgot-password">Esqueceu a senha?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>