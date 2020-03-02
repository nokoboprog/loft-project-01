<?php

require_once('config.php');

//Cписок всех зарегистрированных пользователей.
echo '<b style="color: brown">Список всех пользователей:</b><br><br>';
echo '<table style="border: 1px solid #000">';
$th = "<th style='border: 1px solid #000'>";
$td = "<td style='border: 1px solid #000'>";
echo "<tr>{$th}№</th>{$th}Имя</th>{$th}Email</th>{$th}Телефон</th></tr>";
$query = $pdo->query('SELECT * FROM users');
while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    echo "<tr>{$td}{$row->id}</td>{$td}$row->name</td>{$td}$row->email</td>{$td}$row->phone</td></tr>";
}
echo '</table><br><br>';

//Cписок всех заказов.
echo '<b style="color: brown">Список всех заказов:</b><br><br>';
echo '<table style="border: 1px solid #000">';
echo "<tr>{$th}№</th>{$th}Имя</th>{$th}Email</th>{$th}Телефон</th>";
echo "{$th}Адрес</th>{$th}Комментарий</th>{$th}Потребуется сдача/<br>Оплата по карте</th>{$th}Перезвонить</th>";
$query = $pdo->query('SELECT orders.*, users.email, users.name, users.phone FROM orders LEFT JOIN users ON users.id = orders.user_id GROUP BY orders.id');
while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    echo "<tr>{$td}{$row->id}</td>{$td}$row->name</td>{$td}$row->email</td>{$td}$row->phone</td>{$td}$row->address</td>{$td}$row->comment</td>{$td}$row->payment</td>{$td}$row->callback</td></tr>";
}
echo '</table>';
