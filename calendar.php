<?php
    include_once './include/class.php';
    include_once './include/config.php';

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
    <?php
        $day = 1;
        $day2 = 1;
    ?>
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
                    <tr class="date">
                        <?php
                            if ($row == 1) {
                                $startDayOfWeek = 1;
                                $endDayOfWeek = 7-$firstDay;
                            } else {
                                $endDayOfWeek = (7*$row)-$firstDay;
                                $startDayOfWeek = $endDayOfWeek-6;

                                if($endDayOfWeek > $totalDay){
                                    $endDayOfWeek = $totalDay;
                                }
                            }

                            for ($col=0; $col < 7 ; $col++) {
                                echo "<td>";
                                if( ! ( ($row==1 && $col<$firstDay) || ($row==$totalWeek && $col>$lastDay) ) ){
                                    echo $day;
                                    $day++;
                                }
                                echo "</td>";
                            }
                        ?>
                    </tr>
                    <?php
                    $startDayOfWeek = date("Y-m-", $input).sprintf('%02d',$startDayOfWeek); // 이주의 일요일이 며칠인가
                    $endDayOfWeek = date("Y-m-", $input).sprintf('%02d',$endDayOfWeek); // 이주의 토요일이 며칠인가

                    $sql = "SELECT * FROM schedule WHERE s_date BETWEEN '$startDayOfWeek' AND '$endDayOfWeek' || e_date BETWEEN '$startDayOfWeek' AND '$endDayOfWeek' ORDER BY e_date";
                    $result = $mysqli->query($sql);
                    while ($post = $result->fetch_array(MYSQLI_ASSOC)) {

                            echo "<tr>";
                            $colSpan = 0;
                            for ($col=0; $col < 7 ; $col++) {
                                $dayYmd = date("Y-m-d", strtotime("$startDayOfWeek +$col day"));
                                if($post['s_date'] <= $dayYmd && $post['e_date'] >= $dayYmd){
                                    $colSpan++;
                                }
                            }

                            for ($col=0; $col < 7-($colSpan-1) ; $col++) {
                                $dayYmd = date("Y-m-d", strtotime("$startDayOfWeek +$col day"));
                                if($post['s_date'] == $dayYmd){
                                    echo "<td colspan='".$colSpan."' class='schedule-td'>".$post['title']."</td>";
                                } else {
                                    echo "<td></td>";
                                }
                            }
                            echo "</tr>";
                        }
                     ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>

    <tbody>

    </tbody>
