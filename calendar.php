<?php
    include_once '/include/class.php';
    include_once '/include/config.php';

    $input = $_POST['date']; // 구하고자하는 날짜
    $totalDay = date('t', $input); //이달의 일수
    $firstDay = date('w', strtotime(date("Ym", $input)."01")); //1일의 요일
    $lastDay = date('w', strtotime(date("Ym", $input).$totalDay)); //마지막 요일
    $totalWeek = ceil(($firstDay+$totalDay)/7); //이달의 주수

    $prev = strtotime("-1 month", $input); //이전달
    $next = strtotime("+1 month", $input); //다음달
 ?>
<table class="table">
    <input type="hidden" name="current" value="<?php echo date('Y년m월', $input); ?>" class="current">
    <input type="hidden" name="prev" value="<?php echo $prev?>" class="prev">
    <input type="hidden" name="next" value="<?php echo $next?>" class="next">
    <colgroup>
        <col width="14.2857%">
        <col width="14.2857%">
        <col width="14.2857%">
        <col width="14.2857%">
        <col width="14.2857%">
        <col width="14.2857%">
        <col width="14.2857%">
    </colgroup>
    <tbody>
        <tr>
            <th>일</th>
            <th>월</th>
            <th>화</th>
            <th>수</th>
            <th>목</th>
            <th>금</th>
            <th>토</th>
        </tr>
    </tbody>
</table>
<div class="wrap-calendar-table">
    <?php $day = 1; //일수 출력을 위한 변수 ?>
    <?php for ($row = 1; $row <= $totalWeek; $row++) { //총 주수 만큼 행 생성 ?>
        <div class="tb-row">
            <table class="tb-layout">
                <tbody>
                    <tr>
                        <?php
                        for ($col = 0; $col < 7; $col++) {
                            echo "<td></td>";
                        }
                         ?>
                    </tr>
                </tbody>
            </table>
            <table class="tb-list">
                <tbody>
                    <?php

                     ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>

    <tbody>

    </tbody>















    
