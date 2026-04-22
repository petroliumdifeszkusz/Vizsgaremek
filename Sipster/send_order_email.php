<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    $conn = new mysqli("mysql.rackhost.hu", "c100827papaDB", "papaDB1929", "c100827koktel_db");

    if (!$conn->connect_error) {
        $name = $conn->real_escape_string($data['name']);
        $email = $conn->real_escape_string($data['email']);
        $shipping = $conn->real_escape_string($data['shipping'] ?? '');
        $details = $conn->real_escape_string($data['details']);
        $payment = $conn->real_escape_string($data['payment']);
        $date = $conn->real_escape_string($data['date']);

        $items_json = $conn->real_escape_string(json_encode($data['items']));

        $sql = "INSERT INTO rendelesek (name, email, shipping, details, payment, items_json, date) 
                VALUES ('$name', '$email', '$shipping', '$details', '$payment', '$items_json', '$date')";

        $db_success = $conn->query($sql);
    }

    $to = "noreply@papalocska.hu";
    $subject = "Új Sipster Rendelés - " . $data['name'];

    $message = "
    <html>
    <head><title>Új Rendelés</title></head>
    <body style='font-family: Arial, sans-serif; background: #1e1e1e; color: #fff; padding: 20px;'>
        <h2 style='color: #ffd700;'>Új Sipster Rendelés Érkezett!</h2>
        <p><strong>Vásárló:</strong> {$data['name']}</p>
        <p><strong>Email:</strong> {$data['email']}</p>
        <p><strong>Szállítási opció:</strong> {$data['shipping']}</p>
        <p><strong>Cím / GLS automata:</strong> {$data['details']}</p>
        <p><strong>Fizetés:</strong> {$data['payment']}</p>
        <hr style='border: 1px solid #333;'>
        <h3>Tételek:</h3>
        <ul>";

    foreach ($data['items'] as $item) {
        $message .= "<li>{$item['name']} x{$item['qty']} - " . number_format($item['price'] * $item['qty'], 0, ',', ' ') . " Ft</li>";
    }

    $message .= "</ul></body></html>";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Sipster Webshop <noreply@papalocska.hu>" . "\r\n";

    $mail_success = mail($to, $subject, $message, $headers);

    echo json_encode(["success" => isset($db_success) ? $db_success : false]);
}
?>