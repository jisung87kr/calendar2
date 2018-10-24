<?php include_once './include/class.php' ?>
<?php include_once './include/config.php' ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>달력</title>
        <link rel="stylesheet" href="./css/master.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css"> -->
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/cosmo/bootstrap.min.css"> -->

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="head">
                <button type="button" name="button">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <input type="hidden" name="prev" value="" class="prev btn">
                </button>
                <h1><?php echo date("Ymd", time())?></h1>
                <button type="button" name="button">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <input type="hidden" name="next" value="" class="next btn">
                </button>
            </div>
            <div class="body row">
                <div id="calendar" class="col-sm-7"></div>
                <div id="panel" class="col-sm-5">
                    <div class="panel panel-default">
                        <form class="panel-body" action="index.html" method="post">
                            <input type="text" name="" value="" placeholder="search" class="form-control">
                            <input type="submit" name="" value="검색" class="btn btn-default">
                        </form>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">이달 일정</div>
                        <div class="panel-body">
                            리스트
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">일정등록</div>
                        <form class="panel-body" action="write.php" method="post" id="write">
                            <input type="text" name="title" value="" placeholder="제목" class="title form-control">
                            <input type="text" name="s_date" value="" placeholder="시작일" class="s_date form-control" data-provide="datepicker">
                            <input type="text" name="e_date" value="" placeholder="종료일" class="e_date form-control" data-provide="datepicker">
                            <textarea name="content" rows="8" cols="80" class="content form-control"></textarea>
                            <input type="submit" name="" value="등록" class="btn btn-default submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $( ".s_date, .e_date" ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                    dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                    monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                    monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월']
                });

                function getCal(_date){
                    var _date = _date ? _date : '<?php echo time()?>';
                    $.ajax({
                        url: "./calendar.php",
                        type: "POST",
                        cache: false,
                        async: false,
                        data: {
                            date : _date
                        },
                        success: function(e){
                            $("#calendar").text("");
                            $("#calendar").append(e);
                            $(".head h1").text($("#calendar .current").val());
                            $(".head .prev").attr("value", $("#calendar .prev").val());
                            $(".head .next").attr("value", $("#calendar .next").val());
                        }
                    });
                }
                getCal();

                $(".head button").click(function(){
                    var _date = $(this).find("input").val();
                    getCal(_date);
                });
            });
        </script>
    </body>
</html>
