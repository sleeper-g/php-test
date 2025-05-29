<?php
declare(strict_types=1);

const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;
const OPERATION_UPDATE = 4;

$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
    OPERATION_UPDATE => OPERATION_UPDATE . '. Изменить название товара.',
];

/**
 * Выводит список покупок и меню, запрашивает выбор операции.
 * @param array $operations
 * @param array $items
 * @return int
 */
function chooseOperation(array $operations, array $items): int
{
    do {
        system('clear');

        if (count($items) > 0) {
            echo "Ваш список покупок:\n";
            foreach ($items as $item) {
                echo "{$item['name']} (кол-во: {$item['quantity']})\n";
            }
            echo "\n";
        } else {
            echo "Ваш список покупок пуст.\n\n";
        }

        echo "Выберите операцию для выполнения:\n";

        // Если список пуст, не показываем удаление и обновление
        $availableOperations = $operations;
        if (count($items) === 0) {
            unset($availableOperations[OPERATION_DELETE]);
            unset($availableOperations[OPERATION_UPDATE]);
        }

        echo implode("\n", $availableOperations) . "\n> ";
        $input = trim(fgets(STDIN));

        if (!ctype_digit($input) || !array_key_exists((int)$input, $availableOperations)) {
            echo "\n!!! Неизвестный номер операции, повторите попытку.\n";
            echo "Нажмите Enter для продолжения...";
            fgets(STDIN);
            continue;
        }

        return (int)$input;
    } while (true);
}

/**
 * Добавляет товар в список с количеством.
 * @param array $items
 * @return void
 */
function addItem(array &$items): void
{
    echo "Введите название товара для добавления в список:\n> ";
    $name = trim(fgets(STDIN));
    if ($name === '') {
        echo "Название товара не может быть пустым.\n";
        echo "Нажмите Enter для продолжения...";
        fgets(STDIN);
        return;
    }

    echo "Введите количество товара (целое число):\n> ";
    $quantityInput = trim(fgets(STDIN));
    $quantity = filter_var($quantityInput, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
    if ($quantity === false) {
        echo "Некорректное количество. Должно быть целым положительным числом.\n";
        echo "Нажмите Enter для продолжения...";
        fgets(STDIN);
        return;
    }

    // Если товар уже есть, увеличиваем количество
    foreach ($items as &$item) {
        if ($item['name'] === $name) {
            $item['quantity'] += $quantity;
            echo "Количество товара \"$name\" обновлено. Новое количество: {$item['quantity']}.\n";
            echo "Нажмите Enter для продолжения...";
            fgets(STDIN);
            return;
        }
    }
    unset($item);

    // Если товара нет, добавляем новый
    $items[] = ['name' => $name, 'quantity' => $quantity];
    echo "Товар \"$name\" с количеством $quantity добавлен в список.\n";
    echo "Нажмите Enter для продолжения...";
    fgets(STDIN);
}

/**
 * Удаляет товар из списка.
 * @param array $items
 * @return void
 */
function deleteItem(array &$items): void
{
    if (count($items) === 0) {
        echo "Список покупок пуст, удалять нечего.\n";
        echo "Нажмите Enter для продолжения...";
        fgets(STDIN);
        return;
    }

    echo "Текущий список покупок:\n";
    foreach ($items as $item) {
        echo "{$item['name']} (кол-во: {$item['quantity']})\n";
    }
    echo "\nВведите название товара для удаления из списка:\n> ";
    $name = trim(fgets(STDIN));

    $key = null;
    foreach ($items as $index => $item) {
        if ($item['name'] === $name) {
            $key = $index;
            break;
        }
    }

    if ($key !== null) {
        unset($items[$key]);
        $items = array_values($items); // переиндексация
        echo "Товар \"$name\" удалён из списка.\n";
    } else {
        echo "Товар \"$name\" не найден в списке.\n";
    }
    echo "Нажмите Enter для продолжения...";
    fgets(STDIN);
}

/**
 * Выводит список покупок.
 * @param array $items
 * @return void
 */
function printItems(array $items): void
{
    echo "Ваш список покупок:\n";
    if (count($items) > 0) {
        foreach ($items as $item) {
            echo "{$item['name']} (кол-во: {$item['quantity']})\n";
        }
    } else {
        echo "Список пуст.\n";
    }
    echo "Всего " . count($items) . " позиций.\n";
    echo "Нажмите Enter для продолжения...";
    fgets(STDIN);
}

/**
 * Изменяет название товара.
 * @param array $items
 * @return void
 */
function updateItem(array &$items): void
{
    if (count($items) === 0) {
        echo "Список покупок пуст, изменять нечего.\n";
        echo "Нажмите Enter для продолжения...";
        fgets(STDIN);
        return;
    }

    echo "Текущий список покупок:\n";
    foreach ($items as $item) {
        echo "{$item['name']} (кол-во: {$item['quantity']})\n";
    }
    echo "\nВведите название товара, который хотите изменить:\n> ";
    $oldName = trim(fgets(STDIN));

    $key = null;
    foreach ($items as $index => $item) {
        if ($item['name'] === $oldName) {
            $key = $index;
            break;
        }
    }

    if ($key === null) {
        echo "Товар \"$oldName\" не найден в списке.\n";
        echo "Нажмите Enter для продолжения...";
        fgets(STDIN);
        return;
    }

    echo "Введите новое название товара:\n> ";
    $newName = trim(fgets(STDIN));

    if ($newName === '') {
        echo "Новое название не может быть пустым.\n";
        echo "Нажмите Enter для продолжения...";
        fgets(STDIN);
        return;
    }

    // Проверка, не совпадает ли новое имя с уже существующим
    foreach ($items as $index => $item) {
        if ($item['name'] === $newName && $index !== $key) {
            echo "Товар с названием \"$newName\" уже существует в списке.\n";
            echo "Нажмите Enter для продолжения...";
            fgets(STDIN);
            return;
        }
    }

    $items[$key]['name'] = $newName;
    echo "Название товара \"$oldName\" изменено на \"$newName\".\n";
    echo "Нажмите Enter для продолжения...";
    fgets(STDIN);
}

// Основной код программы
$items = [];

do {
    $operationNumber = chooseOperation($operations, $items);

    echo "\nВыбрана операция: " . $operations[$operationNumber] . "\n\n";

    switch ($operationNumber) {
        case OPERATION_ADD:
            addItem($items);
            break;

        case OPERATION_DELETE:
            deleteItem($items);
            break;

        case OPERATION_PRINT:
            printItems($items);
            break;

        case OPERATION_UPDATE:
            updateItem($items);
            break;
    }

    echo "\n-----\n";

} while ($operationNumber !== OPERATION_EXIT);

echo "Программа завершена.\n";

