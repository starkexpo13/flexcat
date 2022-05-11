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
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/Assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <a href="/admin/login/"><img src="/admin/Assets/dist/img/kmaLogo.png" alt="ValStudio" height="45"> ValStudio</a>
    </div>
    <!-- User name -->
<!--    <div class="lockscreen-name">John Doe</div>-->

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <!--<div class="lockscreen-image">
            <img src="../../dist/img/user1-128x128.jpg" alt="User Image">
        </div>-->
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <!--<form class="lockscreen-credentials">
            <div class="input-group">
                <input type="password" class="form-control" placeholder="password">

                <div class="input-group-append">
                    <button type="button" class="btn">
                        <i class="fas fa-arrow-right text-muted"></i>
                    </button>
                </div>
            </div>
        </form>-->
        <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        <?= $message; ?>
    </div>
    <div class="text-center">
        <a href="/admin/login/">Попробуйте авторизоваться снова</a>
    </div>
    <div class="lockscreen-footer text-center">
        <strong>Copyright &copy; 2014-2021 FlexCat CMS.</strong><br>
        All rights reserved
    </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="/admin/Assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin/Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
