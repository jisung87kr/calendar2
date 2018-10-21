<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>달력</title>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="box">
            <input type="button" name="prev" value="prev" class="prev">
            <h1></h1>
            <input type="button" name="next" value="next" class="next">
        </div>
        <div id="calendar"></div>
        <script type="text/javascript">
            $(document).ready(function(){

                function getCal(_date){
                    var _date = _date ? _date : new Date().getTime()/1000;
                    $.ajax({
                        url: "./calendar.php",
                        type: "POST",
                        cache: false,
                        async: false,
                        data: {
                            date : _date
                        },
                        success: function(e){
                            $("#calendar").append(e);
                        }
                    });
                }
                getCal();

                $(".box input").click(function(){

                });
            });
        </script>
    </body>
</html>
