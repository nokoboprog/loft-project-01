<?php

require_once('config.php');

//Получение данных из формы заказа.
$email = trim(htmlspecialchars($_POST['email']));
$name = trim(htmlspecialchars($_POST['name']));
$phone = trim(htmlspecialchars($_POST['phone']));
$street = 'ул. ' . trim(htmlspecialchars($_POST['street']));
$home = 'дом ' . trim(htmlspecialchars($_POST['home']));
$part = 'корпус ' . trim(htmlspecialchars($_POST['part']));
$appt = 'кв. ' . trim(htmlspecialchars($_POST['appt']));
$floor = 'этаж ' . trim(htmlspecialchars($_POST['floor']));
$comment = trim(htmlspecialchars($_POST['comment']));
$payment = isset($_POST['payment']) ? 'Да' : 'Нет';
$callback = isset($_POST['callback']) ? 'Нет' : 'Да';

$forAddress = [$street, $home, $part, $appt, $floor];
$address = implode(', ', $forAddress);

//Регистрация или "авторизация" пользователя по email.
if ($email) {
    $query = $pdo->prepare('SELECT id FROM users WHERE email = :email');
    $query->execute(['email' => $email]);
    $result = $query->fetch(PDO::FETCH_UNIQUE);
    $userId = $result['id'];
    if (!$userId) {
        $query = $pdo->prepare('INSERT INTO users (email, `name`, phone) VALUES (:email, :userName, :phone)');
        $query->execute(['email' => $email, 'userName' => $name, 'phone' => $phone]);
        $userId = $pdo->lastInsertId();
    }
} else {
    echo '<b>Вернитесь в форму заказа и корректно заполните поля.</b>';
}

//Оформление заказа.
if ($userId) {
    $query = $pdo->prepare('INSERT INTO orders (user_id, address, comment, payment, callback) VALUES (:userId, :address, :comment, :payment, :callback)');
    $query->execute(['userId' => $userId, 'address' => $address, 'comment' => $comment, 'payment' => $payment, 'callback' => $callback]);
    $orderId = $pdo->lastInsertId();
    echo '<b>Спасибо за заказ!</b>';
}

//Письмо или запись в файл.
if ($orderId) {
    $query = $pdo->prepare('SELECT COUNT(*) FROM orders WHERE user_id = :user_id');
    $query->execute(['user_id' => $userId]);
    $orderCount = (int)$query->fetch(PDO::FETCH_COLUMN);

    $note = [];
    $note[] = "Заказ №{$orderId}." . PHP_EOL . PHP_EOL;
    $note[] = "Ваш заказ будет доставлен по адресу: {$address}." . PHP_EOL;
    $note[] = "DarkBeefBurger за 500 рублей, 1 шт." . PHP_EOL . PHP_EOL;
    if ($orderCount > 1) {
        $note[] = "Спасибо! Это уже Ваш $orderCount заказ!";
    } else {
        $note[] = 'Спасибо - это Ваш первый заказ!';
    }

    $dirName = 'orders/' . date('dmY');
    if (!is_dir($dirName)) {
        mkdir($dirName, 0777, true);
    }
    $fileName = $dirName . '/order_' . $orderId . '.txt';
    file_put_contents($fileName, implode('', $note));
}
