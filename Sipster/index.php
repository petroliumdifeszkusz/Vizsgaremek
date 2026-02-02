<?php
require_once 'db.php';

// Megnézzük, érkezett-e rendezési kérés, alapértelmezett a név
$sort = $_GET['sort'] ?? 'nev';

// Csak engedélyezett oszlopneveket fogadunk el (biztonság!)
$allowed = ['nev', 'ar_asc', 'ar_desc'];
$orderBy = "nev ASC"; // Alapértelmezett

if ($sort == 'ar_asc') $orderBy = "ar ASC";
if ($sort == 'ar_desc') $orderBy = "ar DESC";

$stmt = $pdo->query("SELECT * FROM termekek ORDER BY $orderBy");
$termekek = $stmt->fetchAll();

include 'view.php';
?>