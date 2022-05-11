<?php
$data['title'] = 'Главная страница | FlexCatCMS';
$this->theme->header('', $data);
$this->theme->block('sidebar');
?>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Стартовая страница</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Стартовая страница</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <h5 class="card-title">FlexCat CMS</h5>

                                <p class="card-text">
                                    Добро пожаловать, <?= $_SESSION['auth_user']; ?> в новую CMS FlexCat!
                                </p>
<!--                                <a href="#" class="card-link">Card link</a>-->
<!--                                <a href="#" class="card-link">Another link</a>-->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                    <!--<div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">Featured</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">Special title treatment</h6>

                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>

                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0">Featured</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">Special title treatment</h6>

                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>-->
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

    <script src="/admin/Assets/plugins/jquery/jquery.min.js"></script>
    <script src="/admin/Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/Assets/dist/js/adminlte.min.js"></script>
    <script src="/admin/Assets/dist/js/demo.js"></script>
<?php
$this->theme->footer();