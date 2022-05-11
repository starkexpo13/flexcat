<?php
$data['title'] = 'Пользователи | FlexCatCMS';
$this->theme->header('', $data);
$this->theme->block('sidebar');
?>

    <div class="content-wrapper mt-5 pt-3 minHeight">
        <section class="content">
            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill"
                       href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home"
                       aria-selected="true">Данные</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill"
                       href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile"
                       aria-selected="false">Результат тестирования</a>
                </li>
            </ul>
        </section>
    </div>

    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
             aria-labelledby="custom-content-above-home-tab">
            <?php
            $form = new \Core_Form([
                'title' => 'Пользователи',
                'ownLink' => '/users/',
                'fields' => $interface
            ]);
            $form->description = 'Редактирование данных пользователя';
            $form->models = $data[0];
            $form->render();
            ?>
        </div>
        <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel"
             aria-labelledby="custom-content-above-profile-tab">
            <div class="content-wrapper pb-1">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1><?= $testOptions->title; ?></h1>
                                <p>
                                    Всего вопросов в тесте:
                                    <stong><?= $testOptions->bally ?></stong>
                                    <br>
                                    Правильных ответов:
                                    <stong><?= $data[0]->result; ?></stong>
                                </p>
                            </div>
                            <div class="col-sm-4">
                                <a href="/admin/users/clear/<?= $data[0]->id ?>" class="btn btn-app float-right">
                                    <i class="fas fa-eraser"></i>
                                    Очистить результат
                                </a>
                                <a href="#savePDF" class="btn btn-app float-right">
                                    <i class="fa fa-file-pdf mr-1"></i> Скачать в PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content mb-1">
                    <div class="card card-secondary">
                        <div class="card-body" id="printContent">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            110000 Қазақстан, Қостанай қ.<br>
                                            Рабочая к. 155, 1-қабат <br>
                                            Т: +77772408756, +7(7142)579742
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <div class="row mb-3">
                                            <img src="/admin/Assets/dist/img/logoprint_profile.png" alt="logo"
                                                 style="height: 6em;" class="ml-auto mr-auto">
                                        </div>
                                        <div class="row">
                                            <p align="center">«КОСТАНАЙСКИЙ АТТЕСТАЦИОННЫЙ ЦЕНТР СТРОИТЕЛЬ» ЖШС</p>
                                            <p align="center">ТОО «КОСТАНАЙСКИЙ АТТЕСТАЦИОННЫЙ ЦЕНТР СТРОИТЕЛЬ»</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <p class="ml-auto" align="right">
                                            110000 Казахстан, г. Костанай <br>
                                            ул. Рабочая 155, 1 этаж <br>
                                            E:
                                            <a href="mailto:www.attestacentr.kz@mail.ru">www.attestacentr.kz@mail.ru</a>,
                                            <br>
                                            <a href="mailto:umarova_sv@mail.ru">umarova_sv@mail.ru</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>
                                        No <span style="display:flex; width: 270px; border-bottom: 1px solid #000000; margin-left: 15px;"></span>
                                    </p>
                                </div>
                                <div class="row">
                                    20<span style="display:flex; width: 50px; border-bottom: 1px solid #000000; margin-left: 0;"></span>ж./г.
                                    «<span style="display:flex; width: 50px; border-bottom: 1px solid #000000; margin-left: 0;"></span>»
                                    <span style="display:flex; width: 120px; border-bottom: 1px solid #000000; margin-left: 0;"></span>
                                </div>
                                <div class="row pt-3">
                                    <h5 class="mt-3" style="margin-left: auto; margin-right: auto" align="center"><?= $testOptions->title; ?></h5>
                                </div>
                                <div class="row pt-3">
                                    <h2 class="mt-3"><?= $data[0]->name ?></h2>
                                </div>
                                <div class="row">
                                    <h3 class="text-secondary">ИИН: <?= $data[0]->username; ?></h3>
                                </div>
                                <div class="row">
                                    <h4>Результат: <?= $testOptions->bally ?>/<?= $data[0]->result; ?></h4>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="testResult">
                                        <?php foreach ($results as $k => $item): ?>
                                            <?php
                                            $num = $k + 1;
                                            ?>
                                            <div class="card mb-1">
                                                <div class="card-body">
                                                    <blockquote class="blockquote mb-0">
                                                        <p><?= $item->question; ?></p>
                                                        <?php
                                                        if (intval($item->trues) > 0) {
                                                            $trueColor = '<i class="fa fa-check-circle text-success"></i>';
                                                        } else {
                                                            $trueColor = '<i class="fa fa-window-close text-danger"></i>';
                                                        }
                                                        ?>
                                                        <footer class="blockquote-footer">
                                                            <?= $trueColor . " " . $item->answer; ?>
                                                        </footer>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="/admin/Assets/dist/js/html2pdf.bundle.js"></script>
<?php
var_dump($data['name']);
?>
    <script>
        $(function () {
            var level = $('select[name="level"]').val(),
                $pass = $('input[name="password"]');
            if ($pass.val().length > 3) {
                $pass.val('');
            }

            if (parseInt(level) === 3) {
                $('label[for="username_id"]').text('Логин');
                $('input[name="password"]').parents('.form-group').show();
                $('input[name="email"]').parents('.form-group').hide();
                $('input[name="other"]').parents('.form-group').hide();
                $('select[name="groups"]').parents('.form-group').hide();
                $('input[name="username"]').removeClass('numericOnly');
            } else {
                $('label[for="username_id"]').text('ИИН');
                $('input[name="password"]').parents('.form-group').hide();
                $('input[name="email"]').parents('.form-group').show();
                $('input[name="other"]').parents('.form-group').show();
                $('select[name="groups"]').parents('.form-group').show();
                $('input[name="username"]').addClass('numericOnly');
            }

            $('select[name="level"]').on("change", function () {
                if (parseInt($(this).val()) === 3) {
                    $('label[for="username_id"]').text('Логин');
                    $('input[name="password"]').parents('.form-group').show();
                    $('input[name="email"]').parents('.form-group').hide();
                    $('input[name="other"]').parents('.form-group').hide();
                    $('select[name="groups"]').parents('.form-group').hide();
                    $('input[name="username"]').removeClass('numericOnly');
                } else {
                    $('label[for="username_id"]').text('ИИН');
                    $('input[name="password"]').parents('.form-group').hide();
                    $('input[name="email"]').parents('.form-group').show();
                    $('input[name="other"]').parents('.form-group').show();
                    $('select[name="groups"]').parents('.form-group').show();
                    $('input[name="username"]').addClass('numericOnly');
                }

            });

            $('a[href="#savePDF"]').on('click', function (e) {
                e.preventDefault();
                const element = document.getElementById('printContent');
                html2pdf()
                    .set({
                        filename: '<?= $data[0]->name ?>  - <?= $testOptions->title; ?>.pdf'
                    })
                    .from(element)
                    .save();

                setTimeout(function () {
                    $('#printContent').fadeOut();
                }, 2000);
            });
        });
    </script>
    <style>
        .content-wrapper.minHeight {
            min-height: auto !important;
            margin-bottom: 30px;
            background: none !important;
        }
        #testResult .card{
            box-shadow: none !important;

        }
        #testResult .blockquote{
            border: none !important;
        }
    </style>
<?php
$this->theme->footer();