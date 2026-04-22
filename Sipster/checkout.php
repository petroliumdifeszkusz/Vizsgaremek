<?php session_start(); ?>

<?php include 'includes/header.php'; ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>

<main class="page-container" style="max-width: 1100px;">
    <h1 class="page-title">Pénztár</h1>

    <div class="checkout-grid">

        <div class="form-container" style="margin: 0; width: 100%; text-align: left;">
            <form id="sipster-order-form" onsubmit="handleOrderSubmit(event)">

                <h3 style="color: var(--gold); margin-top: 0;">1. Vásárló adatai</h3>
                <div class="form-group">
                    <label>Teljes név</label>
                    <input type="text" id="cust-name" class="form-control" required placeholder="Példa Béla">
                </div>
                <div class="form-group">
                    <label>Email cím</label>
                    <input type="email" id="cust-email" class="form-control" required placeholder="bela@email.hu">
                </div>

                <h3 style="color: var(--gold); margin-top: 30px;">2. Átvétel módja</h3>
                <select id="shipping-method" class="form-control" onchange="toggleShippingFields()"
                    style="margin-bottom: 20px;">
                    <option value="home">Házhozszállítás (+1 490 Ft)</option>
                    <option value="gls">GLS Csomagautomata (+1 490 Ft)</option>
                </select>

                <div id="home-address-section">
                    <div class="form-group">
                        <label>Szállítási cím</label>
                        <input type="text" id="cust-address" class="form-control"
                            placeholder="Irányítószám, Város, Utca...">
                    </div>
                </div>

                <div id="gls-box-section"
                    style="display: none; background: #262626; padding: 20px; border-radius: 12px; border: 1px solid #333; margin-bottom: 25px;">

                    <label
                        style="display: block; color: #888; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; text-align: center;">Átvételi
                        pont beállítása</label>

                    <button type="button" class="btn" onclick="openMap()"
                        style="background: var(--gold); color: black; border: none; font-size: 0.9rem; width: 100%; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 15px;">
                        <span style="font-size: 1.1rem;"></span> GLS Automata választása
                    </button>

                    <div id="selectedBoxDisplay"
                        style="color: var(--gold); background: #1a1a1a; font-weight: 500; padding: 12px; border: 1px solid #444; border-radius: 8px; text-align: center; font-size: 0.9rem; min-height: 20px;">
                        <span style="opacity: 0.6;">Nincs automata kiválasztva</span>
                    </div>
                </div>

                <h3 style="color: var(--gold); margin-top: 30px;">3. Fizetés</h3>
                <select id="payment-method" class="form-control">
                    <option value="cash">Utánvét (Helyszínen)</option>
                    <option value="card">Bankkártya (Online)</option>
                </select>

                <button type="submit" class="btn"
                    style="width: 100%; margin-top: 30px; padding: 20px; font-size: 1.2rem;">
                    RENDELÉS MEGERŐSÍTÉSE
                </button>
            </form>
        </div>

        <div class="summary-box">
            <h3 style="color: var(--gold); margin-top: 0;">Rendelésed</h3>
            <div id="checkout-items-list">
            </div>

            <div style="margin-top: 20px; border-top: 1px solid #444; padding-top: 15px;">
                <div style="display: flex; justify-content: space-between; color: #aaa; margin-bottom: 10px;">
                    <span>Szállítási díj:</span>
                    <span>1 490 Ft</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; font-size: 1.5rem; font-weight: bold; color: var(--gold);">
                    <span>Összesen:</span>
                    <span id="checkout-final-total">0 Ft</span>
                </div>
            </div>
        </div>

    </div>
</main>

<div id="gls-modal" class="modal" style="display: none;">
    <div class="modal-content"
        style="padding: 30px; max-width: 900px; background: var(--card); border: 1px solid var(--gold); border-radius: 20px;">
        <span class="close-modal" onclick="document.getElementById('gls-modal').style.display='none'">&times;</span>
        <h2 class="page-title">GLS Csomagpont választó</h2>

        <div id="map"
            style="width: 100%; height: 450px; border-radius: 10px; margin-top: 20px; border: 1px solid #444; position: relative; z-index: 10;">
        </div>

        <div style="margin-top: 15px;">
            <select id="boxSelect" class="form-control" onchange="selectBoxFromList()"></select>
        </div>

        <button type="button" class="btn" style="margin-top: 20px;" onclick="confirmSelection()">Kiválasztás
            megerősítése</button>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    function toggleShippingFields() {
        const method = document.getElementById('shipping-method').value;
        const homeSection = document.getElementById('home-address-section');
        const glsSection = document.getElementById('gls-box-section');

        if (method === 'gls') {
            homeSection.style.display = 'none';
            glsSection.style.display = 'block';
        } else {
            homeSection.style.display = 'block';
            glsSection.style.display = 'none';
        }
    }

    function initCheckout() {
        const cart = JSON.parse(localStorage.getItem("sipster_cart")) || [];
        const list = document.getElementById('checkout-items-list');
        const totalDisplay = document.getElementById('checkout-final-total');

        if (cart.length === 0) {
            window.location.href = 'index.php';
            return;
        }

        let subtotal = 0;
        list.innerHTML = "";

        cart.forEach(item => {
            subtotal += item.price * item.qty;
            list.innerHTML += `
            <div class="checkout-item">
                <span style="color: white;">${item.name} <small style="color:#888;">x${item.qty}</small></span>
                <span style="color: var(--gold);">${new Intl.NumberFormat('hu-HU').format(item.price * item.qty)} Ft</span>
            </div>
        `;
        });

        totalDisplay.textContent = new Intl.NumberFormat('hu-HU').format(subtotal + 1490) + " Ft";
    }

    let map, mapInitialized = false;
    let tempBox = null;
    const boxes = [
        { name: "GLS Box - WestEnd", lat: 47.5111, lng: 19.0560 },
        { name: "GLS Box - Allee", lat: 47.4766, lng: 19.0474 },
        { name: "GLS Box - Árkád", lat: 47.5009, lng: 19.1466 },
        { name: "GLS Box - Deák", lat: 47.4979, lng: 19.0503 },
        { name: "GLS Box - Corvin", lat: 47.4858, lng: 19.0701 },
        { name: "Sipster HQ", lat: 47.4979, lng: 19.0402 }
    ];

    function openMap() {
        const modal = document.getElementById("gls-modal");

        if (modal) {
            modal.style.display = "flex";
        } else {
            console.error("Hiba: Nem találom a 'gls-modal' elemet!");
            return;
        }

        if (!mapInitialized) {
            map = L.map('map').setView([47.4979, 19.0402], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            const select = document.getElementById('boxSelect');
            boxes.forEach((box, i) => {

                const marker = L.marker([box.lat, box.lng], {
                    clickable: true,
                    interactive: true
                }).addTo(map);

                marker.on('click', function () {
                    tempBox = box;
                    updateTempText();
                });

                if (select) {
                    const opt = document.createElement('option');
                    opt.value = i;
                    opt.textContent = box.name;
                    select.appendChild(opt);
                }
            });
            mapInitialized = true;
        }
        setTimeout(() => {
            if (map) map.invalidateSize();
        }, 300);
    }

    function selectBoxFromList() {
        const val = document.getElementById('boxSelect').value;
        if (val !== "") {
            tempBox = boxes[val];
            map.setView([tempBox.lat, tempBox.lng], 15);
            updateTempText();
        }
    }


    function updateTempText() {
        const display = document.getElementById('selectedBoxDisplay');
        if (tempBox) {
            display.innerHTML = `<strong>Kiválasztva:</strong> ${tempBox.name}`;
            display.style.borderColor = "var(--gold)";
            display.style.background = "rgba(243, 232, 122, 0.05)"; 
        }
    }

    function confirmSelection() {
        if (tempBox) {
            document.getElementById('selectedBoxDisplay').innerText = "📍 " + tempBox.name;
            closeMap();
        }
    }

    function closeMap() { document.getElementById("gls-modal").style.display = "none"; }

    function handleOrderSubmit(e) {
        e.preventDefault();

        const name = document.getElementById('cust-name').value;
        const email = document.getElementById('cust-email').value;
        const method = document.getElementById('shipping-method').value;
        const payment = document.getElementById('payment-method').value;
        const cart = JSON.parse(localStorage.getItem("sipster_cart")) || [];

        let details = "";
        if (method === 'gls') {
            details = document.getElementById('selectedBoxDisplay').innerText;
        } else {
            details = document.getElementById('cust-address').value;
        }

        const newOrder = {
            name,
            email,
            shipping: method,
            details: details,
            payment,
            items: cart,
            date: new Date().toLocaleString('hu-HU')
        };

        const orders = JSON.parse(localStorage.getItem("sipster_orders")) || [];
        orders.push(newOrder);
        localStorage.setItem("sipster_orders", JSON.stringify(orders));

        localStorage.removeItem("sipster_cart");
        if (typeof updateCartCount === "function") updateCartCount();

        const mainContainer = document.querySelector('main.page-container');
        mainContainer.style.opacity = '0';
        mainContainer.style.transition = 'opacity 0.5s';

        fetch('send_order_email.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newOrder)
        })
            .then(response => response.json())
            .then(data => {
                console.log("Email küldés állapota:", data.success ? "Sikeres" : "Hiba történt");
            })
            .catch(error => console.error("Hálózati hiba az email küldésekor:", error));

        setTimeout(() => {
            mainContainer.innerHTML = `
            <div style="text-align: center; padding: 50px 0;">
                <div style="font-size: 5rem; margin-bottom: 20px;">🎉</div>
                <h1 class="page-title">Sikeres rendelés!</h1>
                <p style="color: #ccc; margin-bottom: 30px;">Köszönjük a bizalmadat, ${name}! A rendelésedet rögzítettük.</p>
                
                <div style="background: var(--card); padding: 30px; border-radius: 15px; border: 1px solid #333; max-width: 500px; margin: 0 auto;">
                    <h3 style="color: var(--gold); margin-top:0;">Hogy tetszett a vásárlás?</h3>
                    <p style="color: #888; font-size: 0.9rem;">Értékeld a Sipster élményt:</p>
                    <div id="starsContainer" style="font-size: 45px; cursor: pointer; margin: 20px 0; display: flex; justify-content: center; gap: 10px;">
                        <span class="star" data-value="1" style="color: #444; transition: 0.3s;">&#9733;</span>
                        <span class="star" data-value="2" style="color: #444; transition: 0.3s;">&#9733;</span>
                        <span class="star" data-value="3" style="color: #444; transition: 0.3s;">&#9733;</span>
                        <span class="star" data-value="4" style="color: #444; transition: 0.3s;">&#9733;</span>
                        <span class="star" data-value="5" style="color: #444; transition: 0.3s;">&#9733;</span>
                    </div>
                    <p id="rating-status" style="color: var(--gold); font-weight: bold; min-height: 1.5em; margin: 0;"></p>
                </div>
                <br>
                <a href="index.php" class="btn" style="text-decoration:none; display:inline-block; margin-top:20px; padding: 15px 30px;">Vissza a főoldalra</a>
            </div>
        `;
            mainContainer.style.opacity = '1';
            initStarsLogic();
        }, 500);
    }

    function initStarsLogic() {
        const stars = document.querySelectorAll("#starsContainer .star");
        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener("mouseenter", () => {
                const val = parseInt(star.dataset.value);
                stars.forEach(s => s.style.color = parseInt(s.dataset.value) <= val ? "var(--gold)" : "#444");
            });

            star.addEventListener("mouseleave", () => {
                stars.forEach(s => s.style.color = parseInt(s.dataset.value) <= selectedRating ? "var(--gold)" : "#444");
            });

            star.addEventListener("click", () => {
                selectedRating = parseInt(star.dataset.value);
                document.getElementById('rating-status').innerText = "Köszönjük az értékelést: " + selectedRating + "/5";

                fetch('save_rating.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ rating: selectedRating })
                });

                document.getElementById('starsContainer').style.pointerEvents = 'none';
            });
        }); 
    } 

    // Start
    document.addEventListener('DOMContentLoaded', initCheckout);
</script>