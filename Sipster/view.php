<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipster - Prémium Koktél Webshop</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>Sipster</h1>
    <p>A stílusos kortyok otthona</p>
</header>

<div class="sorting-container">
    <span>Rendezés:</span>
    <a href="index.php?sort=nev" class="sort-link">Név szerint</a> |
    <a href="index.php?sort=ar_asc" class="sort-link">Legolcsóbb előre</a> |
    <a href="index.php?sort=ar_desc" class="sort-link">Legdrágább előre</a>
</div>

<main class="grid">
    <?php if (empty($termekek)): ?>
        <p>Jelenleg nincsenek elérhető koktélok.</p>
    <?php else: ?>
        <?php foreach ($termekek as $koktel): ?>
            <div class="card">
                <img src="assets/img/<?= htmlspecialchars($koktel['kep_nev']) ?>" 
                     alt="<?= htmlspecialchars($koktel['nev']) ?>" 
                     class="card-image">
                
                <div class="card-body">
                    <h2><?= htmlspecialchars($koktel['nev']) ?></h2>
                    <p><?= htmlspecialchars($koktel['leiras']) ?></p>
                    <div class="price"><?= number_format($koktel['ar'], 0, '', ' ') ?> Ft</div>
                    <button class="btn">Kosárba teszem</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<footer>
    <p style="text-align: center; margin-top: 50px;">&copy; 2026 Sipster Cocktail Shop</p>
</footer>

</body>
</html>