<?php
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $conn = new mysqli("mysql.rackhost.hu", "c100827papaDB", "papaDB1929", "c100827koktel_db");

    $order_id = (int) $data['id'];

    $sql = "DELETE FROM rendelesek WHERE id = $order_id";
    $success = $conn->query($sql);

    echo json_encode(["success" => $success]);
} else {
    echo json_encode(["success" => false, "error" => "Nem kaptam ID-t!"]);
}
?>