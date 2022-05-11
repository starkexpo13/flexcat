$(function () {
    /*---pagination---*/
    var countAll = $('.card[data-item]').length,
        contAnswer = parseInt(countAll);


    $('#countAll').text(countAll);

    $('#pagination').on('click', '.buttonQuestion', function (e) {
        e.preventDefault();
        var link = $(this).attr('href'),
            $nowQuestion = $('#nowQuestion'),
            nowPage = Number.parseInt($nowQuestion.text());

        if (link === '#next' && nowPage < countAll) {
            $('.card[data-item="'+nowPage +'"]').addClass('hide-card');
            $('.pageNum[data-num="'+nowPage +'"]').removeClass('activeNum');
            nowPage = nowPage + 1;
            $('.card[data-item="'+nowPage +'"]').removeClass('hide-card');
            $('.pageNum[data-num="'+nowPage +'"]').addClass('activeNum');

        }
        if (link === '#prev' && nowPage !== 1) {
            $('.card[data-item="'+nowPage +'"]').addClass('hide-card');
            $('.pageNum[data-num="'+nowPage +'"]').removeClass('activeNum');
            nowPage = nowPage - 1;
            $('.card[data-item="'+nowPage +'"]').removeClass('hide-card');
            $('.pageNum[data-num="'+nowPage +'"]').addClass('activeNum');
        }
        $nowQuestion.text(nowPage);
    });

    $('.listNumberPages').on('click', '.pageNum', function (e) {
       e.preventDefault();
       var $nowQuestion = $('#nowQuestion'),
           nowPage = Number.parseInt($nowQuestion.text()),
           newPage = Number.parseInt($(this).attr('data-num'));

        $('.card[data-item="'+nowPage +'"]').addClass('hide-card');
        $('.card[data-item="'+newPage +'"]').removeClass('hide-card');
        $('.pageNum[data-num="'+nowPage +'"]').removeClass('activeNum');
        $('.pageNum[data-num="'+newPage +'"]').addClass('activeNum');
        $nowQuestion.text(newPage);
    });

    var userID = $('input[name="userID"]').val();
    localStorage.setItem('userID', userID);

    /*--background num questions--*/
    $('.answer').on('click', function () {
        var key = $(this).attr('data-key'),
            questID= $(this).attr('data-id-quest'),
            answerID = $(this).attr('data-id-answer');

        localStorage.setItem(questID, answerID);
        localStorage.setItem('userID', userID);

        $('.pageNum[data-num="'+ key +'"]').addClass('bg-success');
    });

    function setupDefault(){
        $('.answer').each( function () {
           var questID= $(this).attr('data-id-quest'),
               answerID = localStorage.getItem(questID),
               key = $(this).attr('data-key'),
               nowUserID = userID;

           if (answerID !== null && nowUserID === $(this).attr('data-id-user')) {
               // console.log("QUEST: " + questID);
               // console.log("ANSWER: " + answerID);
               // console.log("KEY: " + key);


               $('.answer[data-id-answer="'+ answerID +'"]').prop('checked', true);
               $('.pageNum[data-num="'+ key +'"]').addClass('bg-success');
           }
        });
    }
    setupDefault();

    /*--enter number only--*/
    jQuery.fn.ForceNumericOnly =
        function(sdrer)
        {
            return this.each(function()
            {
                $(this).keydown(function(e)
                {
                    var key = e.charCode || e.keyCode || 0;
                    // Разрешаем backspace, tab, delete, стрелки, обычные цифры и цифры на дополнительной клавиатуре
                    return (
                        key == 8 ||
                        key == 9 ||
                        key == 46 ||
                        (key >= 37 && key <= 40) ||
                        (key >= 48 && key <= 57) ||
                        (key >= 96 && key <= 105));
                });
            });
        };
    $(".numberOnly").ForceNumericOnly();

    /*--timer--*/
    var remain_bv   =  $('#timecount').val();
    remain_bv = parseInt(remain_bv);

    function parseTime_bv(timestamp){
        if (timestamp < 0) timestamp = 0;

        var day = Math.floor( (timestamp/60/60) / 24);
        var hour = Math.floor(timestamp/60/60);
        var mins = Math.floor((timestamp - hour*60*60)/60);
        var secs = Math.floor(timestamp - hour*60*60 - mins*60);
        var left_hour = Math.floor( (timestamp - day*24*60*60) / 60 / 60 );


        var timeLabel = hour + " час. " + mins + " мин. " + secs + " сек.";
        $('.button-time').val(timeLabel);

        //$('span.afss_day_bv').text(day);
        $('span.afss_hours_bv').text(left_hour);

        if(String(mins).length > 1)
            $('span.afss_mins_bv').text(mins);
        else
            $('span.afss_mins_bv').text("0" + mins);
        if(String(secs).length > 1)
            $('span.afss_secs_bv').text(secs);
        else
            $('span.afss_secs_bv').text("0" + secs);
    }

    /*--save result--*/
    function sendsTestSavesResult(){
        $('form[name="testUser"]').submit();
    }

    /*--time out of timer--*/
    $('#myAlert').hide();

    // $('#myAlert').fadeIn('slow');
    var vis = 0,
        krug = 0;

    setInterval(function(){
        remain_bv = remain_bv - 1;
        parseTime_bv(remain_bv);

        if(remain_bv <= 300 && vis <= 0){
            // alert("Осталось 5 минут");
            $('#myAlert').fadeIn('slow');
            vis = 5;
        }

        if(remain_bv <= 0){
            //  alert('Время вышло!');
            if(krug <= 0){

                sendsTestSavesResult();
                krug = krug + 1;
                // setTimeout(function() { location.reload();	}, 3000);
            }
        }
    }, 1000);


    /*--alerts--*/
    $('.alertClose').on('click', function (e) {
        e.preventDefault();
        $(this).parents('.alert').fadeOut();
    });


    $('#submitForm').on('click', function (e) {
        e.preventDefault();
        var countAnswerFalse = 0;

        $('.pageNum ').each(function () {
            if ($(this).hasClass('bg-success') === false) {
                countAnswerFalse = countAnswerFalse + 1;
            }
        });


        if (countAnswerFalse > 0) {
            $('#modalMessageQuestions').show();
        } else {
            $('#modalMessageQuestions').hide();
        }

        $('#exampleModal').modal('show');
    });

    $('.closeModal').on('click', function (e) {
        e.preventDefault();
        $('#exampleModal').modal('hide');
    });

    $('#savesTest').on('click', function (e) {
        e.preventDefault();
        $('#testUserForm').submit();
    });


});