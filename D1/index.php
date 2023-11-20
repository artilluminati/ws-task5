<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="calendar.css">
</head>

<body>

<?php

if (isset($_GET['m']) && $_GET['y']) {
    $curMonth = htmlspecialchars($_GET['m']);
    $curYear = htmlspecialchars($_GET['y']);
}
else{
    $curMonth = date('m');
    $curYear = date('Y');
}


function getNextMonth($m, $y) {
    $time = gmdate('Y-m-d',strtotime($y.'-'.$m.'-15'));
    $nextMonth = date('m',strtotime('+1 month', strtotime($time)));
    $nextYear = date('Y',strtotime('+1 month', strtotime($time)));
    return '?m='.$nextMonth.'&y='.$nextYear;
}

function getPrevMonth($m, $y) {
    $time = gmdate('Y-m-d',strtotime($y.'-'.$m.'-15'));
    $prevMonth = date('m',strtotime('-1 month', strtotime($time)));
    $prevYear = date('Y',strtotime('-1 month', strtotime($time)));
    return '?m='.$prevMonth.'&y='.$prevYear;
}

function getMonthCalendar($month, $year) {
    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year); // Получаем количество дней в указанном месяце
    $firstDay = date("N", strtotime("$year-$month-01")); // Получаем номер дня недели первого дня месяца

    // Создаем массив с названиями дней недели
    $daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    // Создаем массив для хранения календаря
    $calendar = [];

    // Заполняем массив календаря пустыми значениями
    for ($i = 0; $i < 5; $i++) {
        for ($j = 0; $j < 7; $j++) {
            $calendar[$i][$j] = "";
        }
    }

    echo '<div class="custom-calendar-wrap">';
    echo '<div class="custom-inner">';
    echo '<div class="custom-header clearfix">';
    echo '<nav>';
    echo '<a href="' . getPrevMonth($month, $year) . '" class="custom-btn custom-prev"></a>';
    echo '<a href="' . getNextMonth($month, $year) . '" class="custom-btn custom-next"></a>';
    echo '</nav>';
    echo '<h2 id="custom-month" class="custom-month">' . date("F", strtotime("$year-$month-01")) . '</h2>';
    echo '<h3 id="custom-year" class="custom-year">' . $year . '</h3>';
    echo '</div>';
    echo '<div id="calendar" class="fc-calendar-container">';
    echo '<div class="fc-calendar fc-five-rows">';
    echo '<div class="fc-head">';

    // Заполняем массив календаря днями месяца
    for ($i = 0; $i < 5; $i++) {
        for ($j = ($i == 0 ? $firstDay -1 : 0); $j < 7; $j++) {
            if ($day <= $numDays) {
                
                if ($day == date("j") && $month == date("m") && $year == date("Y")) {
                    $calendar[$i][$j] = $day;
                } else {
                    $calendar[$i][$j] = $day;
                }
                $day++;
            } else {
                break;
            }
        }
    }

    // Выводим заголовок календаря
    
    foreach ($daysOfWeek as $day) {
        
    }
    echo '</div>';
    echo '<div class="fc-body">';
    // var_dump(date("j"));
    // var_dump(date("n"));
    // var_dump(date("Y"));
    // var_dump($calendar);
    foreach ($calendar as $week) {
        echo '<div class="fc-row">';
        foreach ($week as $day) {
            $dayn = preg_replace('!\d+!', '', $day);
            // var_dump($daynum);
            if (isset($day)) {
                if ($dayn == date("j") && strval($month) == date("m") && strval($year) == date("Y")) {
                    echo '<div class="fc-today"><span class="fc-date">' . $day . '</span></div>';
                } else {
                    echo '<div><span class="fc-date">' . $day . '</span></div>';
                }
            } else {
                echo '<div><span class="fc-date"></span></div>';
            }
            
        }
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

getMonthCalendar($curMonth, $curYear);

?>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        for (let e of document.getElementsByClassName('fc-date')){
            if (e.innerText == "<?php echo date('j') ?>" && <?php echo $curYear?> == <?php echo date('Y')?> && <?php echo $curMonth?> == <?php echo date('n')?>){
                e.parentElement.classList.add('fc-today');
            }
        }
    });
</script>

</body>

</html>