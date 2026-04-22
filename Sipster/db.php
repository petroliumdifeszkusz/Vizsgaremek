<?php

$host = 'localhost'; // EZ MARAD!
$db = 'c100827koktel_db'; // c100827
$user = 'c100827papaDB'; // c100827
$pass = 'papaDB1929';
$charset = 'utf8mb4'; // EZ MARAD!

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
?>