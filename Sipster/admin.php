<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'includes/header.php';

$db_orders = [];
$db_ratings = [];

try {
    $conn = new mysqli("mysql.rackhost.hu", "c100827papaDB", "papaDB1929", "c100827koktel_db");

    if ($conn->connect_error) {
        throw new Exception("Kapcsolódási hiba: " . $conn->connect_error);
    }

    $res_orders = $conn->query("SELECT * FROM rendelesek ORDER BY id ASC");
    if ($res_orders) {
        while ($row = $res_orders->fetch_assoc()) {
            $row['items'] = json_decode($row['items_json'], true);
            $db_orders[] = $row;
        }
    }

    $res_ratings = $conn->query("SELECT * FROM ertekelesek");
    if ($res_ratings) {
        while ($row = $res_ratings->fetch_assoc()) {
            $row['rating'] = (int) $row['rating'];
            $db_ratings[] = $row;
        }
    }
} catch (Exception $e) {
    echo "<div style='background: red; color: white; padding: 20px; text-align: center; margin-top: 50px;'>
            <h1>Adatbázis hiba az Admin oldalon!</h1>
            <p>" . $e->getMessage() . "</p>
         </div>";
}
?>

<main class="page-container" style="max-width: 1000px;">
    <h1 class="page-title">Adminisztráció</h1>

    <div id="admin-stats-container"></div>

    <h3 style="color: var(--gold); border-bottom: 1px solid #333; padding-bottom: 10px;">Beérkezett rendelések</h3>
    <div id="admin-orders-list"></div>

</main>

<?php include 'includes/footer.php'; ?>

<script>
    function loadAdminPage() {
        const orders = <?php echo json_encode($db_orders); ?> || [];
        const ratings = <?php echo json_encode($db_ratings); ?> || [];

        let totalRevenue = 0;
        orders.forEach(o => {
            let subtotal = 0;
            if (o.items) {
                subtotal = o.items.reduce((s, i) => s + (i.price * i.qty), 0);
            }
            totalRevenue += (subtotal + 1490);
        });

        const avgRating = ratings.length
            ? (ratings.reduce((sum, r) => sum + r.rating, 0) / ratings.length).toFixed(1)
            : "0.0";

        const statsContainer = document.getElementById('admin-stats-container');
        if (statsContainer) {
            statsContainer.innerHTML = `
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
                <div style="background: var(--card); padding: 25px; border-radius: 15px; border: 1px solid var(--gold); text-align: center;">
                    <p style="color: #888; margin: 0; font-size: 0.8rem; text-transform: uppercase;">Összbevétel</p>
                    <h2 style="color: var(--gold); margin: 10px 0 0 0; font-size: 2rem;">${new Intl.NumberFormat('hu-HU').format(totalRevenue)} Ft</h2>
                </div>
                <div style="background: var(--card); padding: 25px; border-radius: 15px; border: 1px solid var(--gold); text-align: center;">
                    <p style="color: #888; margin: 0; font-size: 0.8rem; text-transform: uppercase;">Értékelés</p>
                    <h2 style="color: var(--gold); margin: 10px 0 0 0; font-size: 2rem;">⭐ ${avgRating} / 5</h2>
                </div>
            </div>
        `;
        }

        const list = document.getElementById('admin-orders-list');
        if (!list) return;

        if (orders.length === 0) {
            list.innerHTML = "<p style='text-align:center; color:#555; padding: 40px;'>Nincs még leadott rendelés az adatbázisban.</p>";
            return;
        }

        list.innerHTML = "";
        orders.reverse().forEach(order => {
            let itemsHtml = '';
            if (order.items) {
                itemsHtml = order.items.map(i => `<div style="display:flex; justify-content:space-between; font-size: 0.9rem;"><span>${i.name} x${i.qty}</span><span>${new Intl.NumberFormat('hu-HU').format(i.price * i.qty)} Ft</span></div>`).join('');
            }

            list.innerHTML += `
            <div style="background: var(--card); border: 1px solid #333; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid #444; padding-bottom: 10px; margin-bottom: 15px;">
                    <div>
                        <strong style="color: var(--gold); display: block; font-size: 1.2rem;">${order.name}</strong>
                        <span style="color: #666; font-size: 0.8rem;">${order.date}</span>
                    </div>
                    <button onclick="deleteOrder(${order.id})" style="background: transparent; border: 1px solid #ff4444; color: #ff4444; padding: 5px 10px; border-radius: 5px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='#ff4444'; this.style.color='white'" onmouseout="this.style.background='transparent'; this.style.color='#ff4444'">Törlés</button>
                </div>
                <p style="margin: 5px 0;">📧 ${order.email}</p>
                <p style="margin: 5px 0;">🚚 ${order.details}</p>
                <div style="background: #1a1a1a; padding: 15px; border-radius: 8px; margin-top: 15px;">
                    ${itemsHtml}
                </div>
            </div>
        `;
        });
    }

    function deleteOrder(orderId) {
        if (confirm("Biztosan törölni szeretnéd ezt a rendelést? Ez a művelet nem vonható vissza!")) {

            fetch('delete_order.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: orderId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert("Hiba történt a törlés során!");
                    }
                })
                .catch(err => console.error("Hálózati hiba:", err));
        }
    }

    document.addEventListener('DOMContentLoaded', loadAdminPage);
</script>