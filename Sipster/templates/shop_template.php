<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipster - Koktél Webshop</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <h1>Sipster</h1>
    <nav>Termékek | Kosár | Kapcsolat</nav>
</header>

<main class="container">
    <h2>Válogass prémium koktéljainkból</h2>
    
    <div class="product-grid">
        <?php foreach ($termekek as $termek): ?>
            <div class="product-card">
                <img src="assets/img/<?= htmlspecialchars($termek['kep_nev']) ?>" alt="<?= htmlspecialchars($termek['nev']) ?>">
                <h3><?= htmlspecialchars($termek['nev']) ?></h3>
                <p><?= htmlspecialchars($termek['leiras']) ?></p>
                <div class="price"><?= number_format($termek['ar'], 0, '', ' ') ?> Ft</div>
                <button class="buy-btn">Kosárba</button>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Sipster Cocktail Shop</p>
</footer>

</body>
</html>