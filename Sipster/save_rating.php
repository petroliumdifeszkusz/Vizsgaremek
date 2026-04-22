<?php
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['rating'])) {
    $conn = new mysqli("mysql.rackhost.hu", "c100827papaDB", "papaDB1929", "c100827koktel_db");

    $rating = (int) $data['rating'];
    $date = date("Y. m. d. H:i:s");

    $sql = "INSERT INTO ertekelesek (rating, date) VALUES ($rating, '$date')";
    $conn->query($sql);

    echo json_encode(["success" => true]);
}
?>