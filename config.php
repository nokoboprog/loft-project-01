<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_burgers', 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
