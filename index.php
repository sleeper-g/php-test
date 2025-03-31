#!/usr/bin/env php
<?php
echo "Ввод двух чисел: ";
$values = explode(" ", trim(fgets(STDIN)));

if (count($values) !== 2) {
    fwrite(STDERR, "Введите, пожалуйста, 2 числа." . PHP_EOL);
    exit();
} elseif ($values[1] === 0) {
    fwrite(STDERR, "Делить на 0 нельзя" . PHP_EOL);
    exit();
};

foreach ($values as $value) {
    if (!is_numeric($value)) {
        fwrite(STDERR, "Введите, пожалуйста, число." . PHP_EOL);
        exit();
    };
};

fwrite(STDOUT, $values[0] / $values[1] . PHP_EOL);
?>