<?php
$data['title'] = 'Авторизация | КОСТАНАЙСКИЙ АТТЕСТАЦИОННЫЙ ЦЕНТР СТРОИТЕЛЬ';
$this->theme->header('', $data);
?>

    <div class="container-fluid header"><!--bg-blue-->
        <div class="container">
            <div class="row ">
                <div class="col-9">
                    <div class="d-flex flex-md-nowrap align-items-center justify-content-start">
                    <img src="/cms/Assets/img/logoprint.png" alt="КОСТАНАЙСКИЙ АТТЕСТАЦИОННЫЙ ЦЕНТР СТРОИТЕЛЬ"
                         class="logo-header mr-3">
                    <p class="ml-3 pl-3 mt-2">ТОО «КОСТАНАЙСКИЙ АТТЕСТАЦИОННЫЙ ЦЕНТР СТРОИТЕЛЬ»</p>
                    </div>
                </div>
                <div class="col-3">
                    <ul class="listLang">
                        <?php
                        $activeKZ = '';
                        $activeRU = '';
                        if (isset($_GET['lang'])) {
                            $lang = trim(htmlspecialchars(stripcslashes($_GET['lang'])));
                            if (mb_strtolower($lang) == 'kz') {
                                $activeKZ = ' activeLang';
                            } else {
                                $activeRU = ' activeLang';
                            }
                        } else {
                            $activeRU = ' activeLang';
                        }
                        ?>
                        <li><a href="/?lang=ru" class="<?= $activeRU ?>">RU</a></li>
                        <li><a href="/?lang=kz" class="<?= $activeKZ ?>">KZ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<div class="login-box m-auto">
    <div class="card mt-5">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><?= $langOption['login_label_message'] ?></p>
            <form action="/login/" method="post">
                <div class="row">
                <div class="input-group mb-3">
                    <input type="text" name="login" class="form-control numberOnly" placeholder="<?= $langOption['login_label_placeholder'] ?>" required>
                </div>
                <div class="input-group">
                    <button type="submit" name="authrorizated" class="btn btn-primary btn-block ml-md-auto"><?= $langOption['login_button_in'] ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>