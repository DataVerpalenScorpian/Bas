<?php
include 'insert_leveranciers.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="bas.css">
    <title>Leverancier toevoegen</title>
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
    <h2>Leverancier toevoegen</h2>
    <form method="POST" action="">
        <label for="levid">Leverancier ID:</label>
        <input type="text" name="levid" required><br><br>
       
        <label for="levnaam">Naam:</label>
        <input type="text" name="levnaam" required><br><br>
       
        <label for="levcontact">Contactpersoon:</label>
        <input type="text" name="levcontact" required><br><br>
     
        <label for="levemail">E-mail:</label>
        <input type="email" name="levemail" required><br><br>
       
        <label for="levadres">Adres:</label>
        <input type="text" name="levadres" required><br><br>
        
        <label for="levpostcode">Postcode:</label>
        <input type="text" name="levpostcode" required><br><br>
      
        <label for="levwoonplaats">Woonplaats:</label>
        <input type="text" name="levwoonplaats" required><br><br>
        <br>
        <input type="submit" name="insertLeverancier" value="Leverancier toevoegen">
    </form>
    <br><br>
    <a href="CRUD_artikelen.php" class="button">Artikelenbeheer</a>
    <br><br>
    <a href="Index.php" class="button">Terug naar Homepage</a>
</body>
</html>
