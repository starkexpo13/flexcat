<?php
$data['title'] = 'Профиль | КОСТАНАЙСКИЙ АТТЕСТАЦИОННЫЙ ЦЕНТР СТРОИТЕЛЬ';
$this->theme->header('', $data);
?>

    <nav class="navbar navbar-light bg-light fixed-top topNavbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar" style="margin-left: auto !important;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                 aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title"
                        id="offcanvasNavbarLabel"><?= $langOption['profile_label_myProfile'] ?></h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <?php if (date('d-m-Y', $user->lastvisitDate) !== '01-01-1970'): ?>
                            <li class="nav-item">
                                <a><?= $langOption['profile_label_date'] ?>:
                                    <strong><?= date('d-m-Y', $user->lastvisitDate) ?></strong>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a><?= $langOption['profile_label_all_quest'] ?>:
                                <strong><?= $countTest; ?></strong></a>
                        </li>
                        <li class="nav-item mt-3">
                            <a href="<?= \Core_LinkProxy::getLink(); ?>/logout/"
                               class="nav-link btn btn-danger text-white"><?= $langOption['button_logout'] ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <br><br><br>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <h1 class="text-center"><?= $user->name ?></h1>
            <h2 class="text-center"><?= $test->title ?></h2>
            <br><br>
            <?php
            if ($user->testingstatus == 1 || $user->datetest > 0) {
                $buttonCaption = $langOption['button_test_start_two'];
            } else {
                $buttonCaption = $langOption['button_test_start'];
            }
            ?>

            <?php if (intval($user->block) <= 0 && intval($user->testinguser) == 0 && intval($test->published) > 0): ?>
                <a href="/test/" class="btn btn-success" style="width: 280px;"><?= $buttonCaption ?></a>
            <?php endif; ?>
            <?php if (intval($user->block) > 0 && $user->testingstatus <= 0): ?>
                <p class="alert alert-warning"><?= $langOption['message_blocked']; ?></p>
            <?php endif; ?>
            <?php if (intval($test->published) == 0): ?>
                <p class="alert alert-danger"><?= $langOption['message_publish']; ?></p>
            <?php endif; ?>
        </div>

        <?php if (intval($user->testinguser) > 0): ?>
            <div class="row">
                <div class="col-4">
                    <?php if (intval($user->testinguser) > 0): ?>
                    <a href="#savePDF" class="btn btn-secondary mb-3 mt-3">
                        <i class="bi bi-file-pdf"></i> <?= $langOption['result_button_save_pdf'] ?>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="col-8"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item">
                                    <a class="nav-link tabLink active"
                                       href="#result"><?= $langOption['result_label_result'] ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tabLink"
                                       href="#myAnswer"><?= $langOption['result_label_answer'] ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="result" class="infoAnswer">
                                <h5 class="card-title"><?= $langOption['result_label_test_result'] ?>:</h5>
                                <p class="card-text"><?= $langOption['result_label_question_sum'] ?>:
                                    <strong><?= $countTest; ?></strong></p>
                                <p class="card-text"><?= $langOption['result_label_question_sum_trues'] ?>:
                                    <strong><?= $user->result; ?></strong></p>
                                <?php if ($user->result >= $test->bally): ?>
                                    <h2 class="text-success"><?= $langOption['result_message_successful']; ?></h2>
                                <?php endif; ?>
                                <?php if ($user->result < $test->bally): ?>
                                    <h2 class="text-danger"><?= $langOption['result_message_danger']; ?></h2>
                                <?php endif; ?>
                            </div>
                            <div id="myAnswer" class="infoAnswer hide-card">
                                <?php foreach ($results as $k => $item): ?>
                                    <?php
                                    $num = $k + 1;
                                    ?>
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <?= $langOption['result_label_questions']; ?> <?= $num; ?>:
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p><?= $item->question; ?></p>
                                                <?php
                                                if (intval($item->trues) > 0) {
                                                    $trueColor = '<i class="bi bi-check-circle-fill text-success"></i>';
                                                } else {
                                                    $trueColor = '<i class="bi bi-x-circle-fill text-danger"></i>';
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
            <div class="row" id="printContent">
                <div class="col-12">
                    <div class="card text-center">
                        <div class="card-header">
                            <h1 class="text-center"><?= $user->name ?></h1>
                            <h2 class="text-center"><?= $test->title ?></h2>
                            <h5 class="card-title"><?= $langOption['result_label_test_result'] ?>:</h5>
                            <p class="card-text"><?= $langOption['result_label_question_sum'] ?>:
                                <strong><?= $countTest; ?></strong></p>
                            <p class="card-text"><?= $langOption['result_label_question_sum_trues'] ?>:
                                <strong><?= $user->result; ?></strong></p>
                        </div>
                        <div class="card-body">
                            <?php foreach ($results as $k => $item): ?>
                                <?php
                                $num = $k + 1;
                                ?>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <?= $langOption['result_label_questions']; ?> <?= $num; ?>:
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p><?= $item->question; ?></p>
                                            <?php
                                            if (intval($item->trues) > 0) {
                                                $trueColor = '<i class="bi bi-check-circle-fill text-success"></i>';
                                            } else {
                                                $trueColor = '<i class="bi bi-x-circle-fill text-danger"></i>';
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
            <script src="/cms/Assets/js/html2pdf.bundle.js"></script>
        <?php endif; ?>
    </div>

    <script>
        $(function () {
            $('.tabLink').on('click', function (e) {
                e.preventDefault();
                var block = $(this).attr('href');

                $('.tabLink').removeClass('active');
                $(this).addClass('active');
                $('.infoAnswer').addClass('hide-card');
                $(block).removeClass('hide-card');

            });

            $('a[href="#savePDF"]').on('click', function (e) {
                e.preventDefault();
                $('#printContent').show();

                const element = document.getElementById('printContent');
                html2pdf()
                    .set({
                        filename: '<?= $user->name ?> - <?php echo date("d.m.Y", time()); ?>.pdf'
                    })
                    .from(element)
                    .save();

               setTimeout(function () {
                   $('#printContent').fadeOut();
               }, 2000);
            });

            <?php
            if ($user->testingstatus > 0) {
                echo ' localStorage.clear(); ';
            }
            ?>
        });
    </script>

<?php
$this->theme->footer();
?>