<?php
declare(strict_types=1);

if (!isset($_GET['text']))
{
    http_response_code(400);
    exit ("Параметр 'test' не передан");
}


header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="download.txt"');
echo $_GET['text'];
