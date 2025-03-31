#!/usr/bin/env php
<?php
echo "Ввод двух чисел: ";
$userInput = fgets(STDIN);
$values = explode(" ", trim($userInput));

if (count($values) !== 2) {
    fwrite(STDERR, "Введите, пожалуйста, 2 числа." . PHP_EOL);
    exit();
}

foreach ($values as $value) {
    if (!is_numeric($value) || intval($value) != $value) {
        fwrite(STDERR, "Введите, пожалуйста, число." . PHP_EOL);
        exit();
    }
}

$number1 = intval($values[0]);
$number2 = intval($values[1]);

if ($number2 === 0) {
    fwrite(STDERR, "Делить на 0 нельзя" . PHP_EOL);
    exit();
}

$result = $number1 / $number2;
echo $result . PHP_EOL;
?>