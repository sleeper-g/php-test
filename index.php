#!/usr/bin/env php
<?php
# requirement: php-mbstring
function prompt(string $inputQuestion) : string {
    echo $inputQuestion;
    $user_input = trim(fgets(STDIN));
    if ( $user_input ) {
        return mb_ucfirst($user_input);
    } else {
        fwrite(STDOUT, "Ошибка ввода данных\n");
        exit(0);
    };
};
$first_name = prompt("Имя: ");
$last_name = prompt("Фамилия: ");
$mid_name = prompt("Отчество: ");
$fullname = "${last_name} ${first_name} ${mid_name}";
$surnameAndInitials = $last_name . ' ' . mb_substr($first_name, 0, 1) 
. '.' . mb_substr($mid_name, 0, 1) . '.';
$fio = mb_substr($last_name, 0, 1) . mb_substr($first_name, 0, 1) 
. mb_substr($mid_name, 0, 1);
echo "Полное имя: ${fullname}";
echo "Фамилия и инициалы: ${surnameAndInitials}";
echo "Аббревиатура: ${fio}";
?>