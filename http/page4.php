<?php
declare(strict_types=1);

session_start();

$count = $_SESSION['page3_visits'] ?? 0;
echo 'Страница 3 была открыта ' . $count . 'раз(а)';