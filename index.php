<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>달력</title>
    </head>
    <body>
<?php
    $input = strtotime('2018-11-21'); // 구하고자하는 날짜
    $totalDay = date('t', $input); //이달의 일수
    $firstDay = date('w', strtotime(date("Ym", $input)."01")); //1일의 요일
    $lastDay = date('w', strtotime(date("Ym", $input).$totalDay)); //마지막 요일
    $totalWeek = ceil(($firstDay+$totalDay)/7); //이달의 주수
 ?>
    <table>
        <thead>
            <tr>
                <th>일</th>
                <th>월</th>
                <th>화</th>
                <th>수</th>
                <th>목</th>
                <th>금</th>
                <th>토</th>
            </tr>
        </thead>
        <tbody>
            <?php $day = 1; //일수 출력을 위한 변수 ?>
            <?php for ($row = 1; $row <= $totalWeek; $row++) { //총 주수 만큼 행 생성 ?>
                <tr>
                    <?php
                    for ($col = 0; $col < 7; $col++) { // 열생성
                        echo "<td>";
                        if(! ( ($row == 1 && $col < $firstDay) || ($row == $totalWeek && $col > $lastDay) ) ){ // 행이 1이고 열이 첫날보다 작거나 행이 총주수와 같고 열이 마지막날보다 큰경우가 아닐때만 요일생성
                            echo $day;
                            $day++;
                        }
                        echo "</td>";
                    }
                     ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </body>
</html>
