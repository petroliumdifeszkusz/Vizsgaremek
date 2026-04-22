<?php session_start(); ?>

<?php
require_once 'db.php';

//jott-e rendezesi request
$sort = $_GET['sort'] ?? 'nev';

$allowed = ['nev', 'ar_asc', 'ar_desc'];
$orderBy = "nev ASC";

if ($sort == 'ar_asc')
    $orderBy = "ar ASC";
if ($sort == 'ar_desc')
    $orderBy = "ar DESC";

$stmt = $pdo->query("SELECT * FROM termekek ORDER BY $orderBy");
$termekek = $stmt->fetchAll();

include 'view.php';
?>