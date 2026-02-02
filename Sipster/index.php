<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Sipster - Köszöntünk a bárban</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('assets/img/hero_bg.jpg');
            background-size: cover;
            background-position: center;
            text-align: center;
        }
        .hero h1 { font-size: 5rem; margin-bottom: 10px; }
        .hero p { font-size: 1.5rem; color: #ccc; margin-bottom: 30px; max-width: 600px; }
        .enter-btn {
            padding: 15px 40px;
            font-size: 1.2rem;
            text-decoration: none;
            border: 2px solid var(--gold);
            color: var(--gold);
            border-radius: 50px;
            transition: 0.3s;
            text-transform: uppercase;
            font-weight: bold;
        }
        .enter-btn:hover {
            background: var(--gold);
            color: black;
        }
    </style>
</head>
<body>

<section class="hero">
    <h1>SIPSTER</h1>
    <p>Nem csak egy ital. Egy életérzés. Fedezd fel prémium koktélkínálatunkat a saját otthonod kényelmében.</p>
    <a href="shop.php" class="enter-btn">Irány a bárpult</a>
</section>

</body>
</html>