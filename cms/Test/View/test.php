<?php
$data['title'] = $test->title;
$this->theme->header('', $data);

if (intval($test->type_answer) == 1) {
    $classAnswer = 'list-style-abcd';
} else {
    $classAnswer = 'list-style-number';
}
?>

    <form action="/results/" method="post" name="testUser" id="testUserForm">
        <nav class="navbar navbar-light bg-light fixed-top topNavbar">
            <div class="container">
                <?php if (intval($test->timedo) > 0): ?>
                <button type="submit" class="btn btn-success" id="submitForm">
                    <i class="bi bi-check-lg"></i> <?= $langOption['button_test_finish'] ?>
                </button>
                <?php endif; ?>
                <span class="d-none d-md-flex timeOff">
                <i class="bi bi-alarm fs-5"></i>
                <strong class="mt-2 fw-normal" id="timeHeader">
                    <?= $langOption['profile_label_time'] ?>:
                    <span class="afss_hours_bv">00</span>:<span class="afss_mins_bv">00</span>:<span
                            class="afss_secs_bv">00</span>
                </strong>
            </span>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
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
                            <li class="nav-item">
                                <a class="nav-link timeOff">
                                    <?= $langOption['profile_label_time'] ?>:
                                    <span id="timeProfile">
                                        <span class="afss_hours_bv">00</span> час.
                                        <span class="afss_mins_bv">00</span> мин.
                                        <span class="afss_secs_bv">00&nbsp;</span> сек.
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a><strong><?= $langOption['profile_label_fio'] ?>:</strong><br><?= $user->name ?></a>
                            </li>
                            <li class="nav-item">
                                <a><strong><?= $langOption['profile_label_test'] ?>:</strong><br><?= $test->title ?></a>
                            </li>
                            <li class="nav-item">
                                <a><strong><?= $langOption['profile_label_date'] ?>:</strong> <?= $userDateTest; ?></a>
                            </li>
                            <li class="nav-item">
                                <a><strong><?= $langOption['profile_label_all_quest'] ?>:</strong> <span
                                            id="countAll">0</span></a>
                            </li>
                            <li class="nav-item mt-3">
                                <a href="<?= \Core_LinkProxy::getLink(); ?>/logout/" class="nav-link btn btn-danger text-white">
                                    <i class="bi bi-box-arrow-right"></i> <?= $langOption['button_logout'] ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <br>
        <div class="container mt-1 mt-sm-5">
            <div class="content pt-sm-5" id="pagination" data-now-page="1">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex mt-3 justify-content-between">
                            <a href="#prev" class="btn btn-outline-secondary buttonQuestion">
                                <i class="bi bi-chevron-compact-left"></i> <?= $langOption['button_prev_question'] ?>
                            </a>
                            <a class="fs-3 nowPage"><span id="nowQuestion">1</span></a>
                            <a href="#next" class="btn btn-outline-primary buttonQuestion">
                                <?= $langOption['button_next_question'] ?>
                                <i class="bi bi-chevron-compact-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 pt-3">
                        <?php foreach ($questions as $key => $item): ?>
                            <?php
                            $newKey = $key + 1;
                            if ($newKey !== 1) {
                                $disableClass = 'hide-card';
                            } else {
                                $disableClass = '';
                            }
                            $questionTitle = str_replace('|', '', $item->title);
                            ?>
                            <input type="hidden" name="questions[<?= $newKey ?>]" value="<?= $item->id ?>|<?= $questionTitle ?>">
                            <div class="card <?= $disableClass ?>" data-item="<?= $newKey ?>">
                                <div class="card-header">
                                    <h5><?= $item->title ?></h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush listAnswer <?= $classAnswer ?>">
                                        <?php foreach ($item->answer as $k => $answer): ?>
                                            <?php
                                            $answerTitle = str_replace('|', '', $answer->title);
                                            $trues = base64_encode($answer->trues . "|" .$answer->id);
                                            ?>
                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input answer"
                                                               data-key="<?= $newKey ?>"
                                                               data-id-quest="<?= $answer->idquest ?>"
                                                               data-id-answer="<?= $answer->id ?>"
                                                               data-id-user="<?= $user->id; ?>"
                                                               type="radio"
                                                               name="answer[<?= $newKey ?>]"
                                                               value="<?= $answer->id ?>|<?= $answerTitle ?>|<?= $trues ?>">
                                                        <?= $answer->title ?>
                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <ul class="listNumberPages">
                            <?php for ($i = 1; $i <= $countQuestions; $i++): ?>
                                <?php
                                if ($i == 1) {
                                    $classActiveNum = ' activeNum';
                                } else {
                                    $classActiveNum = '';
                                }
                                ?>
                                <li class="pageNum <?= $classActiveNum ?>" data-num="<?= $i ?>"><?= $i ?></li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="userID" value="<?= $user->id; ?>">
        <input type="hidden" name="testID" value="<?= $test->id; ?>">
    </form>


    <div class="alert alert-danger alert-dismissible fixed-top" role="alert" id="myAlert">
        <strong><?= $langOption['message_time_out'] ?></strong>
        <a href="#close" class="fs-1 text-danger alertClose">
            <i class="bi bi-x"></i>
        </a>
    </div>





    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= $langOption['modal_label_title'] ?></h5>
                    <button type="button" class="btn closeModal" data-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle fs-3"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?= $langOption['modal_message_close_test'] ?></p>
                    <h5 class="text-danger" id="modalMessageQuestions" style="display: none"><?= $langOption['modal_message_answer_error'] ?></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal"><?= $langOption['modal_button_no'] ?></button>
                    <button type="button" class="btn btn-primary" id="savesTest"><?= $langOption['modal_button_yes'] ?></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            /*--show message for close page--*/
            $(document).on("submit", "form", function (event) {
                $(window).off("beforeunload");
            });
            jQuery(window).bind('beforeunload', function (e) {
                var message = "Why are you leaving?";
                e.returnValue = message;
                return message;
            });
        });
    </script>
    <input type="hidden" name="timecount" value="<?= $timecount ?>" id="timecount"/>
<?php
$this->theme->footer();
?>