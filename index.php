<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>달력</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!-- <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/journal/bootstrap.min.css" rel="stylesheet" integrity="sha384-5C8TGNupopdjruopVTTrVJacBbWqxHK9eis5DB+DYE6RfqIJapdLBRUdaZBTq7mE" crossorigin="anonymous"> -->
    </head>
    <style media="screen">
    .head{
        text-align: center;
        border: 1px solid #ccc;
        padding: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .head button{
        display: inline-block;
        background: none;
        border: none;
        vertical-align: middle;
    }

    .head h1{
        display: inline;
        vertical-align: middle;
    }

    </style>
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
            <div class="body">
                <div id="calendar"></div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
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
