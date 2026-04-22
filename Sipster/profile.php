<?php session_start(); ?>


<?php
include 'includes/header.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "c100827papaDB", "papaDB1929", "c100827koktel_db");
$email = $_SESSION['user'];


if (isset($_POST['update_profile'])) {
    $new_username = $conn->real_escape_string($_POST['username']);
    $conn->query("UPDATE felhasznalok SET username='$new_username' WHERE email='$email'");
    $_SESSION['username'] = $new_username;
    $message = "Profil frissítve!";
}

$res = $conn->query("SELECT * FROM felhasznalok WHERE email='$email'");
$user = $res->fetch_assoc();
?>

<main class="page-container" style="max-width: 500px; margin: 50px auto; text-align: center;">
    <h1 class="page-title">Saját Fiók</h1>

    <div style="background: var(--card); padding: 30px; border-radius: 15px; border: 1px solid #333;">
        <p style="color: #888;">Bejelentkezve mint: <br><strong><?= $email ?></strong></p>

        <form method="POST" style="margin-top: 20px;">
            <label style="display: block; margin-bottom: 10px; color: var(--gold);">Felhasználónév:</label>
            <input type="text" name="username" class="form-control"
                value="<?= htmlspecialchars($user['username'] ?? '') ?>" placeholder="Hogy hívhatunk?"
                style="text-align: center;">

            <button type="submit" name="update_profile" class="btn" style="margin-top: 20px;">Mentés</button>
        </form>

        <hr style="border: 0; border-top: 1px solid #444; margin: 30px 0;">

        <a href="shop.php?logout=1" class="btn">Kijelentkezés</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>