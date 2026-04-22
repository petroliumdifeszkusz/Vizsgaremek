<?php include 'includes/header.php'; ?>

<main class="page-container" style="max-width: 1000px;">
    <h1 class="page-title">Lépj velünk kapcsolatba</h1>

    <div class="contact-grid">
        <div class="contact-info">
            <h3>Elérhetőségeink</h3>
            <p>Kérdésed van a rendeléssel kapcsolatban? Esetleg egyedi italt keresel? Írj nekünk!</p>

            <div style="margin-top: 30px;">
                <p><strong>📍 Cím:</strong><br>1051 Budapest, Koktél utca 12.</p>
                <p><strong>📞 Telefon:</strong><br>+36 30 123 4567</p>
                <p><strong>✉️ Email:</strong><br>hello@sipster.hu</p>
            </div>

            <div style="margin-top: 40px; font-size: 1.2rem; color: var(--gold);">
                Facebook &nbsp;|&nbsp; Instagram &nbsp;|&nbsp; TikTok
            </div>
        </div>

        <div class="form-container" id="contact-form-box" style="margin: 0; width: 100%;">
            <form id="sipster-contact-form">
                <div class="form-group">
                    <label>Név</label>
                    <input type="text" class="form-control" required placeholder="A te neved">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" required placeholder="cim@pelda.hu">
                </div>
                <div class="form-group">
                    <label>Üzenet</label>
                    <textarea class="form-control" required placeholder="Miben segíthetünk?"></textarea>
                </div>
                <button type="submit" class="btn" style="margin-top: 15px;">Küldés</button>
            </form>
        </div>
    </div>
</main>
<script>
    // Kapcsolati űrlap kezelése
    document.getElementById('sipster-contact-form')?.addEventListener('submit', function (e) {
        e.preventDefault();

        const container = document.getElementById('contact-form-box');
        container.style.opacity = '0';
        container.style.transition = 'opacity 0.5s';

        setTimeout(() => {
            container.innerHTML = `
                <div style="text-align: center; padding: 40px 0;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">🍸</div>
                    <h2 style="color: var(--gold);">Köszönjük az üzenetet!</h2>
                    <p style="color: #ccc; line-height: 1.6;">Hamarosan jelentkezünk a megadott email címen.</p>
                    <button onclick="location.reload()" class="btn" style="margin-top: 20px; background: transparent; border: 1px solid var(--gold); font-size: 0.8rem;">Új üzenet küldése</button>
                </div>
            `;
            container.style.opacity = '1';
        }, 500);
    });
</script>

<?php include 'includes/footer.php'; ?>