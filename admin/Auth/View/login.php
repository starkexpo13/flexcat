<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Платформа FlexCat CMS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/Assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/admin/Assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/Assets/dist/css/adminlte.min.css">

    <link rel="shortcut icon" href="/admin/Assets/dist/img/favicon.ico">
    <link rel="icon" type="image/png" href="/admin/Assets/dist/img/kmaLogo.png">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/admin/login/"><img src="/admin/Assets/dist/img/kmaLogo.png" alt="ValStudio" height="45"> ValStudio</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Авторизуйтесь, чтобы войти</p>
            <form action="/admin/authorizate/" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="login" class="form-control" placeholder="Логин" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <!--<div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">
                                Запомнить меня
                            </label>
                        </div>-->
                    </div>
                    <div class="col-4">
                        <button type="submit" name="authrorizated" class="btn btn-primary btn-block">Войти</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/admin/Assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin/Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/Assets/dist/js/adminlte.min.js"></script>
</body>
</html>
