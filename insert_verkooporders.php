<?php
include 'conn.php';
include 'verkooporder.php';

// ... rest van de code ...

?>

<!DOCTYPE html>
<html>
<head>
    <title>Verkooporder toevoegen</title>
</head>
<body>
    <h1>Verkooporder toevoegen</h1>
    <form method="POST" action="">
        <label>Klant ID:</label>
        <?php
        $verkooporder = new Verkooporder();
        echo $verkooporder->getKlantDropdown();
        ?>
        <br>
        <label>Artikel ID:</label>
        <?php
        echo $verkooporder->getArtikelDropdown();
        ?>
        <br>
        <label>Verkooporderdatum:</label>
        <input type="text" name="verkorddatum" required>
        <br>
        <label>Aantal:</label>
        <input type="text" name="verkordbestaantal" required>
        <br>
        <label>Status:</label>
        <input type="text" name="verkordstatus" required>
        <br>
        <input type="submit" name="insert" value="Verkooporder toevoegen">
    </form>
</body>
</html>
