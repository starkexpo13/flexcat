<?php
$data['title'] = 'Ошибка авторизации | КОСТАНАЙСКИЙ АТТЕСТАЦИОННЫЙ ЦЕНТР СТРОИТЕЛЬ';
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
                    <li><a href="/auth/?lang=ru" class="<?= $activeRU ?>">RU</a></li>
                    <li><a href="/auth/?lang=kz" class="<?= $activeKZ ?>">KZ</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="login-box m-auto">
    <div class="alert alert-danger mt-5" role="alert" style="width: 450px;">
        <?= $langOption['login_error_message_iin'] ?>, <a href="/" class="alert-link"><?= $langOption['login_error_message_label_link'] ?></a>
    </div>
</div>
</body>
</html>