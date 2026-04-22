[<footer style="margin-top: 50px; padding-bottom: 20px;">
    <p style="text-align: center; color: #666; font-size: 0.9rem;">&copy; 2026 Sipster Cocktail Shop</p>

    <p style="text-align: center; margin-top: 10px;">
        <a href="admin.php" style="color: #333; text-decoration: none; font-size: 0.8rem; transition: 0.3s;"
            onmouseover="this.style.color='#f3e87a'" onmouseout="this.style.color='#333'">Admin panel</a>
    </p>
</footer>

<div id="cart-modal" class="modal">
    <div class="modal-content" style="max-width: 500px; background: var(--card); border: 1px solid #333;">
        <span class="close-modal" onclick="closeCart()">&times;</span>
        <h2 class="page-title" style="font-size: 2rem; text-align: left; margin-top: 0; color: var(--gold);">Poharad
        </h2>

        <div id="cart-items-container" style="margin-bottom: 20px; max-height: 400px; overflow-y: auto;">
        </div>

        <div style="border-top: 1px solid #444; padding-top: 15px; margin-bottom: 20px;">
            <p style="color: #aaa; margin: 0 0 10px 0;">Szállítási díj: <span style="float: right;">1 490 Ft</span></p>
            <h3 style="color: var(--gold); font-size: 1.5rem; margin: 0;">Összesen: <span id="cart-total"
                    style="float: right;">0 Ft</span></h3>
        </div>

        <button class="btn" style="width: 100%; padding: 15px;" onclick="location.href='checkout.php'">TOVÁBB A
            PÉNZTÁRHOZ</button>
    </div>
</div>

<script>
    window.addEventListener('load', function () {
        const overlay = document.getElementById('page-transition');
        if (overlay) {
            overlay.classList.remove('active');
            setTimeout(() => { overlay.style.display = 'none'; }, 800);
        }
    });

    window.addEventListener('pageshow', function (event) {
        const overlay = document.getElementById('page-transition');
        if (event.persisted && overlay) {
            overlay.classList.remove('active');
            overlay.style.display = 'none';
        }
    });

    document.addEventListener('click', function (e) {
        const link = e.target.closest('a');
        if (!link || link.target === '_blank' || link.getAttribute('href').startsWith('#') || link.getAttribute('href').startsWith('javascript')) return;

        e.preventDefault();
        const targetUrl = link.href;
        const overlay = document.getElementById('page-transition');

        if (overlay) {
            overlay.style.display = 'block';
            setTimeout(() => { overlay.classList.add('active'); }, 10);
            setTimeout(() => { window.location.href = targetUrl; }, 500);
        } else {
            window.location.href = targetUrl;
        }
    });


    let cart = JSON.parse(localStorage.getItem("sipster_cart")) || [];

    function saveCart() {
        localStorage.setItem("sipster_cart", JSON.stringify(cart));
        updateCartCount();
    }

    function updateCartCount() {
        const qty = cart.reduce((sum, item) => sum + item.qty, 0);
        const countElement = document.getElementById("cartCount");
        if (countElement) countElement.textContent = qty;
    }

    function addToCart(name, price, image) {
        const item = cart.find(p => p.name === name);
        if (item) {
            item.qty++;
        } else {
            cart.push({ name: name, price: price, image: image, qty: 1 });
        }
        saveCart();


        const cartBtn = document.querySelector('.nav-link[onclick="openCart()"]');
        if (cartBtn) {
            cartBtn.style.transform = "scale(1.2)";
            setTimeout(() => cartBtn.style.transform = "scale(1)", 200);
        }
    }

    function openCart() {
        const cartModal = document.getElementById("cart-modal");
        const cartItems = document.getElementById("cart-items-container");
        const totalPrice = document.getElementById("cart-total");

        cartItems.innerHTML = "";
        let total = 0;

        if (cart.length === 0) {
            cartItems.innerHTML = "<p style='color:#888; text-align:center; padding: 20px;'>A poharad jelenleg üres.</p>";
        } else {
            cart.forEach((item, index) => {
                total += item.price * item.qty;
                cartItems.innerHTML += `
                        <div style="display: flex; align-items: center; justify-content: space-between; background: #1a1a1a; padding: 10px; border-radius: 8px; margin-bottom: 10px; border: 1px solid #333;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <img src="assets/img/${item.image}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                <div>
                                    <strong style="color: white; display: block;">${item.name}</strong>
                                    <span style="color: var(--gold);">${new Intl.NumberFormat('hu-HU').format(item.price)} Ft</span>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <button onclick="changeQty(${index}, -1)" style="background: #333; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">-</button>
                                <span style="color: white; min-width: 20px; text-align: center;">${item.qty}</span>
                                <button onclick="changeQty(${index}, 1)" style="background: #333; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">+</button>
                            </div>
                        </div>
                    `;
            });
        }

        const finalTotal = total > 0 ? total + 1490 : 0;
        totalPrice.textContent = new Intl.NumberFormat('hu-HU').format(finalTotal) + " Ft";
        cartModal.style.display = "flex";
    }

    function closeCart() {
        document.getElementById("cart-modal").style.display = "none";
    }

    function changeQty(index, delta) {
        cart[index].qty += delta;
        if (cart[index].qty <= 0) cart.splice(index, 1);
        saveCart();
        openCart();
    }

    document.addEventListener('DOMContentLoaded', updateCartCount);
</script>
</body>

</html>