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

echo date('w', mktime(0, 0, 0, 11, 19, 2023));

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

    //Создаем массив для хранения календаря
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

    foreach ($daysOfWeek as $day) {
        echo '<div>' . $day . '</div>';
    }
    echo '</div>';
    echo '<div class="fc-body">';
    // Заполняем массив календаря днями месяца
    $d = 0;
    $dayweek = 0;
    for ($i = 0; $i < 5; $i++) {
        echo '<div class="fc-row">';
        for ($j = 0; $j < 7; $j++) {
            var_dump(date('w', mktime(0, 0, 0, $month, $d, $year)));
            echo $month, $d, $year;
            var_dump($dayweek);
            echo '<br>';
            if (intval(date('w', mktime(0, 0, 0, $month, $d, $year))) == $dayweek) {
                echo $dayweek;
                if (strval($day) == date("j")) {
                    echo 'day<br>';
                    echo '<div class="fc-today"><span class="fc-date">' . $d . '</span></div>';
                } else {
                    echo '<br>elseday<br>';
                    echo '<div><span class="fc-date">' . $d . '</span></div>';
                    
                }
                $d++;
            }
            else{
                echo '<div><span class="fc-date"></span></div>';
                if ($dayweek >=7){
                    $dayweek = 0;
                }
                else{
                    $dayweek++;
                }
            }
        }
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    // Выводим заголовок календаря
    
    
    
    // foreach ($calendar as $week) {
        
    //     foreach ($week as $day) {
    //         if ($day != "") {
    //             echo '<div><span class="fc-date">' . $day . '</span></div>';
    //         } else {
    //             echo '<div><span class="fc-date"></span></div>';
    //         }

    //         if ($day == date("j")) {
    //             $calendar[$i][$j] = '<div class="fc-today"><span class="fc-date">' . $day . '</span></div>';
    //         } else {
    //             $calendar[$i][$j] = '<div><span class="fc-date">' . $day . '</span></div>';
    //         }
    //     }
    // }
    
}

getMonthCalendar($curMonth, $curYear);

?>


</body>

</html>