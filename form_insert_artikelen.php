<?php
include 'insert_artikelen.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Artikel toevoegen</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
    <style>
            table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Artikel toevoegen</h2>
    <form method="POST" action="">
        <label for="artid">Artikel ID:</label>
        <input type="text" name="artid" id="artid" required><br>

        <label for="artikelenomschrijving">Artikelomschrijving:</label>
        <input type="text" name="artikelenomschrijving" id="artikelenomschrijving" required><br>

        <label for="artinkoop">Inkoopprijs:</label>
        <input type="text" name="artinkoop" id="artinkoop" required><br>

        <label for="artverkoop">Verkoopprijs:</label>
        <input type="text" name="artverkoop" id="artverkoop" required><br>

        <label for="artvoorraad">Voorraad:</label>
        <input type="text" name="artvoorraad" id="artvoorraad" required><br>

        <label for="artminvoorraad">Minimale voorraad:</label>
        <input type="text" name="artminvoorraad" id="artminvoorraad" required><br>

        <label for="artmaxvoorraad">Maximale voorraad:</label>
        <input type="text" name="artmaxvoorraad" id="artmaxvoorraad" required><br>

        <label for="artlocatie">Locatie:</label>
        <input type="text" name="artlocatie" id="artlocatie" required><br>

        <label for="levid">Leverancier ID:</label>
        <input type="text" name="levid" id="levid" required><br>

        <input type="submit" name="insert" value="Artikel toevoegen">
    </form>
    <br><br>
    <a href="CRUD_artikelen.php" class="button">Artikelenbeheer</a>
    <br><br>
    <a href="Index.php" class="button">Terug naar Homepage</a>
</body>
</html>
