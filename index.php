<?php
// Task 1
echo 'File full name: ' . __FILE__ . "\nNumber of this line: " . __LINE__ . PHP_EOL;
$multiLineVar = <<<END
multi
line
variable
END;
echo $multiLineVar . PHP_EOL;

$user='Ivan';
$food='fish';
echo "$user like to eat $food" . PHP_EOL;

// Task 2
$variable = 3.14;
//$variable = 3;
//$variable = 'one';
//$variable = true;
//$variable = null;
//$variable = [];

if (is_bool($variable)) {
    $type = 'bool';
} elseif(is_float($variable)) {
    $type = 'float';
} elseif(is_int($variable)) {
    $type = 'int';
} elseif(is_string($variable)) {
    $type = 'string';
} elseif(is_null($variable)) {
    $type = 'null';
} else {
    $type = 'other';
};
echo "type is $type" . PHP_EOL;

switch(true) {
    case is_bool($variable):
        $type = 'bool';
        break;
    case is_float($variable):
        $type = 'float';
        break;
    case is_int($variable):
        $type = 'int';
        break;
    case is_string($variable):
        $type = 'string';
        break;
    case is_null($variable):
        $type = 'null';
        break;
    default:
        $type = 'other';
}
echo "type is $type" . PHP_EOL;
?>
