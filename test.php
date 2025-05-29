<?php
declare(strict_types=1);

$c = 11;

function func1(int ...$nums): void
{
    $sum = 0;
    foreach($nums as $num) {
        $sum += $num;
    }
    echo 'Func1: ' . $sum . PHP_EOL;
}

func1(123,124234,234234, $c);
?>