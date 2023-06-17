<?php
require 'conn.php';
require 'Config.php';
require 'classes/klant.php';

// Create an instance of the Klanten class
$klanten = new Klanten();

// Process the form if submitted
if (isset($_POST['submit'])) {
    $klantnaam = $_POST['klantnaam'];
    $klantemail = $_POST['klantemail'];
    $klantadres = $_POST['klantadres'];
    $klantpostcode = $_POST['klantpostcode'];
    $klantwoonplaats = $_POST['klantwoonplaats'];

    $klanten->insertKlant($klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats);
}

// Process the updated customer data if submitted
if (isset($_POST['update'])) {
    $klantid = $_POST['klantid'];
    $klantnaam = $_POST['klantnaam'];
    $klantemail = $_POST['klantemail'];
    $klantadres = $_POST['klantadres'];
    $klantpostcode = $_POST['klantpostcode'];
    $klantwoonplaats = $_POST['klantwoonplaats'];

    $klanten->updateKlant($klantid, $klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats);
}

// Process the deletion of a customer if requested
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $klantid = $_GET['id'];
    $klanten->deleteKlant($klantid);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Klantenbeheer</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
    <style>
    </style>
</head>
<body>
    <h2>Klantenbeheer</h2>

    <h3>Klantenoverzicht</h3>
    <?php $klanten->selectAllKlanten(); ?>

    <h3>Klant toevoegen</h3>
    <form method="post" action="">
        <label>Klantnaam:</label>
        <input type="text" name="klantnaam" required><br><br>
        <label>Klant E-mail:</label>
        <input type="email" name="klantemail" required><br><br>
        <label>Klant Adres:</label>
        <input type="text" name="klantadres" required><br><br>
        <label>Klant Postcode:</label>
        <input type="text" name="klantpostcode" required><br><br>
        <label>Klant Woonplaats:</label>
        <input type="text" name="klantwoonplaats" required><br><br>
        <input type="submit" name="submit" value="Klant toevoegen" class="button">
    </form>

    <h3>Klant bijwerken</h3>
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
        $klantid = $_GET['id'];
        $stmt = $klanten->conn->prepare("SELECT * FROM klanten WHERE klantid = :klantid");
        $stmt->bindParam(':klantid', $klantid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            ?>
            <form method="post" action="">
                <input type="hidden" name="klantid" value="<?php echo $result['klantid']; ?>">
                <label>Klantnaam:</label>
                <input type="text" name="klantnaam" value="<?php echo $result['klantnaam']; ?>" required><br><br>
                <label>Klant E-mail:</label>
                <input type="email" name="klantemail" value="<?php echo $result['klantemail']; ?>" required><br><br>
                <label>Klant Adres:</label>
                <input type="text" name="klantadres" value="<?php echo $result['klantadres']; ?>" required><br><br>
                <label>Klant Postcode:</label>
                <input type="text" name="klantpostcode" value="<?php echo $result['klantpostcode']; ?>" required><br><br>
                <label>Klant Woonplaats:</label>
                <input type="text" name="klantwoonplaats" value="<?php echo $result['klantwoonplaats']; ?>" required><br><br>
                <input type="submit" name="update" value="Klant bijwerken" class="button">
            </form>
            <?php
        } else {
            echo "Geen klant gevonden.";
        }
    }
    ?>

    <br>
    <a href="search_klant.php" class="button">Search Klant</a>
    <br><br>
    <a href="Index.php" class="button">Terug naar Homepage</a>
</body>
</html>
