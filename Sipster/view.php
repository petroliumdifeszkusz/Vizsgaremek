<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipster</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>Sipster</h1>
    <p>A stílusos kortyok otthona</p>
</header>

<div id="age-gate">
    <div class="age-gate-content">
        <h1>SIPSTER</h1>
        <p>A tartalom megtekintéséhez el kell múltál 18 éves.</p>
        <div class="age-gate-buttons">
            <button onclick="verifyAge()" class="age-btn confirm">Elmúltam 18</button>
            <a href="https://youtu.be/XqZsoesa55w?si=Nv2tFGm8s_BqPSdu" class="age-btn deny">Még nem</a>
        </div>
    </div>
</div>

<div class="sorting-container">
    <label for="sort-select">Rendezés: </label>
   <select id="sort-select" onchange="location = 'shop.php?sort=' + this.value.split('=')[1];">
        <option value="index.php?sort=nev" <?php echo ($sort == 'nev' ? 'selected' : ''); ?>>Név szerint (A-Z)</option>
        <option value="index.php?sort=ar_asc" <?php echo ($sort == 'ar_asc' ? 'selected' : ''); ?>>Legolcsóbb elöl</option>
        <option value="index.php?sort=ar_desc" <?php echo ($sort == 'ar_desc' ? 'selected' : ''); ?>>Legdrágább elöl</option>
    </select>
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

<script>
    // Ellenőrizzük, hogy ebben a munkamenetben elfogadták-e már
    if (sessionStorage.getItem('ageVerified') === 'true') {
        document.getElementById('age-gate').style.display = 'none';
    } else {
        document.body.classList.add('age-restricted');
    }

    function verifyAge() {
        // Eltároljuk az infót
        sessionStorage.setItem('ageVerified', 'true');
        
        // Animációk indítása
        const gate = document.getElementById('age-gate');
        gate.classList.add('fade-out');
        document.body.classList.remove('age-restricted');
        
        
        setTimeout(() => {
            document.body.style.filter = "none";
        }, 800);
    }
</script>

<footer>
    <p style="text-align: center; margin-top: 50px;">&copy; 2026 Sipster Cocktail Shop</p>
</footer>

</body>
</html>