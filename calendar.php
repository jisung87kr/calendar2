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
                        $dayYmd = date("Y-m-d", strtotime(date("Y-m", $input).'-'.sprintf('%02d',$day)));
                        if($dayYmd == date("Y-m-d", time())){ // 해당일이 오늘인지 검사
                            $isToday = "today";
                        } else {
                            $isToday = "";
                        }
                        echo "<div class='day ".$isToday."'>".$day."</div>"; //날짜 출력

                        $sql = "SELECT * FROM schedule WHERE s_date <= '$dayYmd' && e_date >= '$dayYmd' ORDER BY e_date";
                        // $sql = "SELECT * FROM schedule WHERE s_date = '$dayYmd'";
                        $result = $mysqli->query($sql);
                        while ($post = $result->fetch_array(MYSQLI_ASSOC)) {
                            echo "<div>".$post['title']."<div>";
                        }
                        $day++;
                    }
                    echo "</td>";
                }
                 ?>
            </tr>
        <?php } ?>
        <?php

         ?>
    </tbody>
</table>
