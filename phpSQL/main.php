<?php

require_once 'Shop.php';
require_once 'Client.php';
require_once 'Order.php';

$pdo = new PDO('sqlite:db.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// === Работа с Shop ===
$shop = new Shop($pdo);

// Добавление магазина
$newShop = $shop->insert(['name', 'address'], ['Test Store', '123 Test Ave']);
print_r($newShop);

// Обновление магазина
$updatedShop = $shop->update($newShop['id'], ['name' => 'Updated Store']);
print_r($updatedShop);

// Поиск магазина
$foundShop = $shop->find($newShop['id']);
print_r($foundShop);

// Удаление магазина
$deleted = $shop->delete($newShop['id']);
echo "Магазин удалён: " . ($deleted ? 'Да' : 'Нет') . "\n";

// === Работа с Client ===
$client = new Client($pdo);
$newClient = $client->insert(['name', 'phone'], ['John Doe', '+1234567890']);
print_r($newClient);

// === Работа с Order ===
$order = new Order($pdo);
$newOrder = $order->insert(['created_at', 'shop_id', 'client_id'], [date('Y-m-d H:i:s'), 1, 1]);
print_r($newOrder);

