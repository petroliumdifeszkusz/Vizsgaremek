[
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: shop.php");
    exit();
}

$current_page = basename($_SERVER['PHP_SELF']);
$szlogenek = [
    "A stílusos kortyok otthona.",
    "Mert minden este megérdemel egy jó befejezést.",
    "Rázva, nem keverve. Vagy ahogy szereted.",
    "A minőség, amit a poharadba tölthetsz.",
    "Merülj el az ízek világában!",
    "Egy korty luxus, neked.",
    "Ma melyik koktél illik a hangulatodhoz?",
    "Szeretem a tejet. Na meg a koktélokat is.",
    "Az igazi stílus a poharadban kezdődik.",
    "Tölts tiszta luxust a poharadba.",
    "Nem csak egy ital. Egy élmény.",
    "Minden cseppjében ott a varázslat.",
    "Koccints az igazán fontos pillanatokra.",
    "Koronázd meg az estét a Sipsterrel.",
    "A nap fénypontja, jéggel tálalva.",
    "Hagyd kint a világot, és kortyolj bele az estébe.",
    "A tökéletes este receptje nálunk kezdődik.",
    "Lazíts stílusosan, a többit bízd ránk.",
    "Keverd újra a szabályokat!",
    "Ízek, amik rabul ejtenek.",
    "Te vagy a mixer, mi adjuk az ihletet.",
    "Élmény, minden kortyban.",
    "Sipster: Rázd fel a mindennapokat!"
];
$szlogen = $szlogenek[array_rand($szlogenek)];

$is_logged_in = isset($_SESSION['user']);
$display_name = 'Fiókom';

if ($is_logged_in) {
    if (!empty($_SESSION['username'])) {
        $display_name = $_SESSION['username'];
    } else {
        $parts = explode('@', $_SESSION['user']);
        $display_name = $parts[0];
    }
}

function getActiveStyle($pageName, $current_page)
{
    return ($pageName == $current_page)
        ? 'color: #d4af37 !important; border-bottom: 2px solid #d4af37;'
        : '';
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipster</title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>

<body>

    <div id="page-transition" class="transition-overlay"></div>

    <header class="site-header">

        <div class="header-container">

            <div class="logo-section">
                <a href="index.php" class="logo-link">
                    <h1>Sipster</h1>
                </a>
                <p class="fade-in-text"><?php echo $szlogen; ?></p>
            </div>

            <button class="hamburger-btn" onclick="document.querySelector('.main-nav').classList.toggle('active')">
                ☰
            </button>

            <nav class="main-nav">
                <a href="shop.php" class="nav-link"
                    style="<?= getActiveStyle('shop.php', $current_page) ?>">Koktélok</a>
                <a href="about.php" class="nav-link"
                    style="<?= getActiveStyle('about.php', $current_page) ?>">Rólunk</a>
                <a href="contact.php" class="nav-link"
                    style="<?= getActiveStyle('contact.php', $current_page) ?>">Kapcsolat</a>

                <?php if ($is_logged_in): ?>
                    <a href="profile.php" class="nav-btn" style="<?= getActiveStyle('profile.php', $current_page) ?>">
                        <?= htmlspecialchars($display_name) ?>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="nav-btn <?= ($current_page == 'login.php') ? 'active-link' : '' ?>">
                        Fiókom
                    </a>
                <?php endif; ?>

                <a href="javascript:void(0)" onclick="openCart()" class="nav-link"
                    style="color: #d4af37; font-weight: bold; margin-left: 10px;">
                    Pohár (<span id="cartCount">0</span>)
                </a>
            </nav>
        </div>
    </header>