<?php

require_once 'vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);

try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_burgers', 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
