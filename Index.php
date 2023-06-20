<!DOCTYPE html>
<html>
<head>
    <title>Bas Supermarkt</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
    <style>
        /* CSS-stijlen voor het menu */
        ul.menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        ul.menu li {
            float: left;
        }

        ul.menu li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.menu li a:hover {
            background-color: #111;
        }

        /* Aanvullende stijlen */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #f44336;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .header h1 {
            font-size: 60px;
            margin-bottom: 10px;
            font-family: 'Arial Black', sans-serif;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .header p {
            font-size: 20px;
            line-height: 1.5;
            margin-bottom: 20px;
            color: white;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 400px;
            background-color: #f9f9f9;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
        }

        h2 {
            font-size: 36px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        p {
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 20px;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bas Supermarkt</h1>
            <p>Voor werknemers en admins</p>
        </div>

        <ul class="menu">
            <li><a href="#">Home</a></li>
            <li><a href="form_update-verkooporder-status.php">Orders</a></li>
            <li><a href="CRUD_artikelen.php">Artikelen</a></li>
            <li><a href="CRUD_klanten.php">Klanten</a></li>
            <li><a href="CRUD_leveranciers.php">Leveranciers</a></li>
        </ul>

        <div class="main-content">
            <h2>Welkom bij Bas Supermarkt</h2>
            <p>Ontdek een wereld van verse en heerlijke boodschappen bij Bas Supermarkt. Wij bieden een breed scala aan hoogwaardige producten om te voldoen aan al uw huishoudelijke behoeften. Van verse producten van de boerderij tot voorraadkastbenodigdheden, wij hebben het allemaal.</p>
            <p>Bij Bas Supermarkt zijn we trots op het bieden van uitzonderlijke klantenservice. Ons vriendelijke personeel staat altijd klaar om u te helpen en zorgt voor een prettige winkelervaring.</p>
            <p>Verken ons uitgebreide assortiment producten, profiteer van onze speciale aanbiedingen en vind alles wat u nodig heeft om memorabele maaltijden te maken voor uw gezin en geliefden.</p>
            <p>Bezoek ons vandaag nog en ervaar het gemak en de kwaliteit van Bas Supermarkt.</p>
        </div>
    </div>
</body>
</html>
