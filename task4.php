#!/usr/bin/env php
<?php
const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;
$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
];
$items = [];

$userChooseAction = function() use ($operations, $items): string
{
    if (count($items)) {
        echo 'Ваш список покупок: ' . PHP_EOL;
        echo implode("\n", $items) . "\n";
    } else {
        echo 'Ваш список покупок пуст.' . PHP_EOL;
    }
    echo 'Выберите операцию для выполнения: ' . PHP_EOL;
    // Проверить, есть ли товары в списке? Если нет, то не отображать пункт про удаление товаров
    echo implode(PHP_EOL, $operations) . PHP_EOL . '> ';
    $operationNumber = trim(fgets(STDIN));
    if (!array_key_exists($operationNumber, $operations)) {
        system('clear');

        echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
    } else {
        return trim(fgets(STDIN));
    }
    
};


do {
    system('clear');
    $operationNumber = $userChooseAction();
    echo 'Выбрана операция: '  . $operations[$operationNumber] . PHP_EOL;
} while ($operationNumber > 0);
echo 'Программа завершена' . PHP_EOL;
?>