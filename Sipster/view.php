

<?php 
include 'includes/header.php'; 
?>

    <div id="age-gate">
        <div class="age-gate-content">
            <h1>Életkor megerősítése</h1>
            <div class="age-gate-buttons">
                <button onclick="verifyAge()" class="age-btn confirm">Elmúltam 18 éves</button>
                <a href="https://youtu.be/XqZsoesa55w?si=Nv2tFGm8s_BqPSdu" class="age-btn deny">Még nem</a>
            </div>
        </div>
    </div>

<div class="controls-wrapper">
    
    <div class="search-section">
        <input type="text" id="cocktailSearch" 
               class="form-control" 
               placeholder="Keress név vagy alapanyag alapján..." 
               onkeyup="filterCocktails()">
    </div>

    <div class="sort-section">
        <label for="sort-select">Rendezés:</label>
        <select id="sort-select" class="form-control" onchange="location = 'shop.php?sort=' + this.value.split('=')[1];">
            <option value="shop.php?sort=nev" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'nev' ? 'selected' : ''); ?>>Név (A-Z)</option>
            <option value="shop.php?sort=ar_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ar_asc' ? 'selected' : ''); ?>>Olcsóbb elöl</option>
            <option value="shop.php?sort=ar_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ar_desc' ? 'selected' : ''); ?>>Drágább elöl</option>
        </select>
    </div>
</div>

    <main class="grid">
        <?php foreach ($termekek as $koktel): ?>
            <div class="card js-modal-trigger"
                data-product="<?= htmlspecialchars(json_encode($koktel), ENT_QUOTES, 'UTF-8') ?>">

                <img src="assets/img/<?= htmlspecialchars($koktel['kep_nev']) ?>"
                    alt="<?= htmlspecialchars($koktel['nev']) ?>" class="card-image">

                <div class="card-simple-info">
                    <h2><?= htmlspecialchars($koktel['nev']) ?></h2>
                </div>
            </div>
        <?php endforeach; ?>
    </main>

    <div id="product-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <div id="modal-body">
                </div>
        </div>
    </div>

    <button id="backToTop" class="back-to-top" onclick="scrollToTop()">&#8679;</button>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ageGate = document.getElementById('age-gate');
            if (sessionStorage.getItem('ageVerified') === 'true') {
                if (ageGate) ageGate.style.display = 'none';
                document.body.classList.remove('age-restricted');
            } else {
                document.body.classList.add('age-restricted');
            }
        });

        function verifyAge() {
            sessionStorage.setItem('ageVerified', 'true');
            const ageGate = document.getElementById('age-gate');
            document.body.classList.remove('age-restricted');
            if (ageGate) {
                ageGate.style.opacity = "0";
                ageGate.style.transition = "opacity 0.5s";
                setTimeout(() => { ageGate.style.display = 'none'; }, 500);
            }
        }

    document.addEventListener('click', function (event) {
        const card = event.target.closest('.js-modal-trigger');
        
        if (card) {
            try {
                const rawData = card.getAttribute('data-product');
                const product = JSON.parse(rawData);
                openModal(product);
            } catch (error) {
                console.error("Hiba az adatok feldolgozásakor:", error);
            }
        }
    });

    function openModal(koktel) {
        const modal = document.getElementById('product-modal');
        const body = document.getElementById('modal-body');

        if (!modal || !body) {
            console.error("Hiba: Nem található a 'product-modal' vagy 'modal-body' elem!");
            return;
        }

        let leiras = koktel.leiras || '';
        let formazottLeiras = leiras.replace(/,/g, '<br>• ');
        if (formazottLeiras.length > 0) {
            formazottLeiras = '• ' + formazottLeiras;
        }

        body.innerHTML = `
        <div class="modal-grid">
            <img src="assets/img/${koktel.kep_nev}" 
                 style="width:100%; height:100%; object-fit:cover; border-radius:15px; border:1px solid #333;"
                 alt="${koktel.nev}">
            
            <div class="modal-details">
                <h1 style="color: var(--gold); font-size: 2.5rem; margin-top:0; line-height: 1.2;">
                    ${koktel.nev}
                </h1>
                
                <p style="color: #ccc; line-height: 1.8; margin: 20px 0;">
                    ${formazottLeiras}
                </p>
                
                <div class="price" style="font-size: 2.2rem; color: var(--gold); font-weight: bold; margin-bottom: 30px;">
                    ${new Intl.NumberFormat('hu-HU').format(koktel.ar)} Ft
                </div>
                
                <button class="btn" onclick="addToCart('${koktel.nev}', ${koktel.ar}, '${koktel.kep_nev}'); closeModal();" style="width: 100%; padding: 18px;">
                    POHÁRBA TESZEM
                </button>
            </div>
        </div>
        `;

        modal.style.display = "block";
        document.body.style.overflow = "hidden";
    }

    function closeModal() {
        const modal = document.getElementById('product-modal');
        if (modal) {
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }
    }

    window.onclick = function (event) {
        const modal = document.getElementById('product-modal');
        if (event.target == modal) closeModal();
    }

        window.onscroll = function () {
            const btn = document.getElementById("backToTop");
            if (!btn.classList.contains("hiding")) {
                if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                    btn.classList.add("show");
                } else {
                    btn.classList.remove("show");
                }
            }
        };

        function scrollToTop() {
            const btn = document.getElementById("backToTop");
            
            btn.classList.add("hiding");
            
            window.scrollTo({ top: 0, behavior: 'smooth' });

            setTimeout(() => {
                btn.classList.remove("hiding");
                btn.classList.remove("show");
            }, 1000);
        }

        function filterCocktails() {
    const input = document.getElementById('cocktailSearch');
    const filter = input.value.toLowerCase();
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        const productData = JSON.parse(card.getAttribute('data-product'));
        const name = productData.nev.toLowerCase();
        const description = productData.leiras.toLowerCase();

        if (name.includes(filter) || description.includes(filter)) {
            card.style.display = ""; 
        } else {
            card.style.display = "none"; 
        }
    });
}
    </script>

<?php 
include 'includes/footer.php'; 
?>