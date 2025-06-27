<?php

function generateSchedule(int $year, int $month): void
{
    $monthName = strftime('%B', mktime(0, 0, 0, $month, 1, $year));
    echo "Расписание на \033[1m{$monthName} {$year}\033[0m\n";

    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    $schedule = [];
    $day = 1;

    // с первого числа
    while ($day <= $daysInMonth) {
        $workDay = $day;

        // проверка выходных дней: 6,7
        $timestamp = mktime(0, 0, 0, $month, $workDay, $year);
	$dayOfWeek = date('N', $timestamp); 
        if ($dayOfWeek == 6) {
            $workDay += 2;
        } elseif ($dayOfWeek == 7) {
            $workDay += 1;
        }

        // проверка конца месяца
        if ($workDay > $daysInMonth) {
            break;
        }

        $schedule[] = $workDay;

        // следующий рабочий день
        $day = $workDay + 3;
    }

    // вывод
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $timestamp = mktime(0, 0, 0, $month, $i, $year);
        $weekday = strftime('%a', $timestamp);
        if (in_array($i, $schedule)) {
            echo "\033[32m{$i} {$weekday} +\033[0m\n";
        } else {
            echo "\033[31m{$i} {$weekday}\033[0m\n";
        }
    }
}

// установка локали
setlocale(LC_TIME, 'ru_RU.UTF-8');

// вызов с учетом года и месяца
generateSchedule(2025, 6);
