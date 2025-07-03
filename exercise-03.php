<?php

declare(strict_types=1);

/**
 * Исключение для типа int
 */
class IntTypeException extends Exception {}

/**
 * Исключение для типа float
 */
class FloatTypeException extends Exception {}

/**
 * Исключение для типа string
 */
class StringTypeException extends Exception {}

/**
 * Исключение для типа bool
 */
class BoolTypeException extends Exception {}

/**
 * Исключение для типа array
 */
class ArrayTypeException extends Exception {}

/**
 * Исключение для значения null
 */
class NullTypeException extends Exception {}

/**
 * Функция определяет тип переданного значения и выбрасывает соответствующее исключение
 *
 * @param mixed $value Значение любого типа
 * @throws IntTypeException
 * @throws FloatTypeException
 * @throws StringTypeException
 * @throws BoolTypeException
 * @throws ArrayTypeException
 * @throws NullTypeException
 * @throws Exception
 */
function calculate(mixed $value): void {
    if (is_int($value)) {
        throw new IntTypeException("Это int");
    } elseif (is_float($value)) {
        throw new FloatTypeException("Это float");
    } elseif (is_string($value)) {
        throw new StringTypeException("Это string");
    } elseif (is_bool($value)) {
        throw new BoolTypeException("Это bool");
    } elseif (is_array($value)) {
        throw new ArrayTypeException("Это array");
    } elseif (is_null($value)) {
        throw new NullTypeException("Это null");
    } else {
        throw new Exception("Неизвестный тип");
    }
}

// Примеры значений для теста
$values = [42, 3.14, "Hello", true, [1, 2, 3], null];

foreach ($values as $val) {
    try {
        calculate($val);
    } catch (IntTypeException $e) {
        echo "Передан тип int\n";
    } catch (FloatTypeException $e) {
        echo "Передан тип float\n";
    } catch (StringTypeException $e) {
        echo "Передан тип string\n";
    } catch (BoolTypeException $e) {
        echo "Передан тип bool\n";
    } catch (ArrayTypeException $e) {
        echo "Передан тип array\n";
    } catch (NullTypeException $e) {
        echo "Передан тип null\n";
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage() . "\n";
    }
}

