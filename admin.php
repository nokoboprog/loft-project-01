<?php

require_once('config.php');

$query = $pdo->query('SELECT * FROM users');
$dataUsers = [];
while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    $dataUsers[] = $row;
}

$query = $pdo->query('SELECT orders.*, users.email, users.name, users.phone FROM orders LEFT JOIN users ON users.id = orders.user_id GROUP BY orders.id');
$dataOrders = [];
while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    $dataOrders[] = $row;
}

$template = $twig->load('admin.twig');
echo $template->render(['users' => $dataUsers, 'orders' => $dataOrders]);
