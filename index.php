<?php

//タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

//表示させる年月を設定 ↓これは現在の月
$year = date('Y');
$month = date('m');

//月末日を取得
$end_month = date('t', strtotime($year.$month.'01'));
//1日の曜日を取得
$first_week = date('w', strtotime($year.$month.'01'));
//月末日の曜日を取得
$last_week = date('w', strtotime($year.$month.$end_month));

$aryCalendar = [];
$j = 0;

//1日開始曜日までの穴埋め
for($i = 0; $i < $first_week; $i++){
    $aryCalendar[$j][] = '';
}

//1日から月末日までループ
for ($i = 1; $i <= $end_month; $i++){
    //日曜日まで進んだら改行
    if(isset($aryCalendar[$j]) && count($aryCalendar[$j]) === 7){
        $j++;
    }
    $aryCalendar[$j][] = $i;
}

//月末曜日の穴埋め
for($i = count($aryCalendar[$j]); $i < 7; $i++){
    $aryCalendar[$j][] = '';
}

$aryWeek = ['日', '月', '火', '水', '木', '金', '土'];

?>

<meta name="viewport" content="width=device-width,initial-scale=1.0" />

<body style="background-color: black; color: #00FF00;">
    <div>
        <?php echo $month . "月"?>
        <?php echo $year?>
    </div>

    <table>
        <!-- 曜日の表示 -->
        <tr>
            <?php foreach($aryWeek as $week){ ?>
            <th><?php echo $week ?></th>
            <?php } ?>
        </tr>
        <!-- 日数の表示 -->
        <?php foreach($aryCalendar as $tr){ ?>
        <tr>
            <?php foreach($tr as $td){ ?>
            <?php if($td != date('j')){ ?>
            <td><?php echo $td ?></td>
            <?php }else{ ?>
            <!-- 今日の日付 -->
            <td style="background-color: #00FF00; color: black;"><?php echo $td ?></td>
            <?php } ?>
            <?php } ?>
        </tr>
        <?php } ?>
    </table>
</body>