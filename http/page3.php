<?php
declare(strict_types=1);

session_start();

if (!isset($_SESSION['page3_visits']))
{
    $_SESSION['page3_visits'] = 0;
}

$_SESSION['page3_visits']++;

if ($_SESSION['page3_visits'] % 3 === 0)
{
    header('Location: page4.php');
    exit;
}
echo "Страница 3 открыта {$_SESSION['page3_visits']} раз(а).";