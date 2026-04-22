<?php
session_start();

$host = 'localhost'; // EZ MARAD!
$db = 'c100827koktel_db'; // c100827
$user = 'c100827papaDB'; // c100827
$pass = 'papaDB1929';
$charset = 'utf8mb4'; // EZ MARAD!

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

$message = "";

if (isset($_POST['register'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT id FROM felhasznalok WHERE email='$email'");
    if ($check->num_rows > 0) {
        $message = "Hiba: Ez az email már foglalt!";
    } else {
        $sql = "INSERT INTO felhasznalok (email, password) VALUES ('$email', '$password')";
        if ($conn->query($sql)) {
            $message = "Sikeres regisztráció! Most már beléphetsz.";
        }
    }
}

if (isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM felhasznalok WHERE email='$email'");
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {

            $_SESSION['user'] = $row['email'];
            $_SESSION['username'] = $row['username'];

            header("Location: index.php");
            exit();
        } else {
            $message = "Hibás jelszó!";
        }
    } else {
        $message = "Nincs ilyen felhasználó!";
    }
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <title>Sipster - Belépés</title>
    <style>
        :root {
            --bg: #1e1e1e;
            --card: #2a2a2a;
            --gold: #d4af37;
            --text: #ccc;
        }

        body {
            margin: 0;
            font-family: sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: var(--card);
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 350px;
            text-align: center;
            border: 1px solid #333;
        }

        h2 {
            color: var(--gold);
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #444;
            background: #1a1a1a;
            color: white;
            box-sizing: border-box;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: var(--gold);
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .toggle {
            margin-top: 20px;
            display: block;
            color: var(--gold);
            text-decoration: none;
            cursor: pointer;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="box">
        <div id="l-form">
            <h2>Belépés</h2>
            <p style="color:var(--gold)"><?php echo $message; ?></p>
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Jelszó" required>
                <button type="submit" name="login" class="btn">MEHET</button>
            </form>
            <a class="toggle" onclick="t()">Még nincs fiókom</a>
        </div>
        <div id="r-form" style="display:none">
            <h2>Regisztráció</h2>
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Jelszó" required>
                <button type="submit" name="register" class="btn">LÉTREHOZÁS</button>
            </form>
            <a class="toggle" onclick="t()">Már van fiókom</a>
        </div>
    </div>
    <script>
        function t() {
            const l = document.getElementById('l-form'), r = document.getElementById('r-form');
            l.style.display = l.style.display === 'none' ? 'block' : 'none';
            r.style.display = r.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>

</html>