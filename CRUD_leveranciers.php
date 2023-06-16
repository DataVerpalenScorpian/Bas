<?php
require 'conn.php';
require 'Config.php';
require 'classes/leverancier.php';

// Create an instance of the Leveranciers class
$leveranciers = new Leveranciers();

// Process the updated supplier data if submitted
if (isset($_POST['update'])) {
    $levid = $_POST['levid'];
    $levnaam = $_POST['levnaam'];
    $levcontact = $_POST['levcontact'];
    $levemail = $_POST['levemail'];
    $levadres = $_POST['levadres'];
    $levpostcode = $_POST['levpostcode'];
    $levwoonplaats = $_POST['levwoonplaats'];

    $leveranciers->updateLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats);
}

// Process the deletion of a supplier if requested
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $levid = $_GET['id'];
    $leveranciers->deleteLeverancier($levid);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Leveranciersbeheer</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
    <style>
    </style>
</head>
<body>
    <h2>Leveranciersbeheer</h2>

    <h3>Leveranciersoverzicht</h3>
    <?php $leveranciers->selectAllLeveranciers(); ?>

    <h3>Leverancier bijwerken</h3>
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
        $levid = $_GET['id'];
        $stmt = $leveranciers->conn->prepare("SELECT * FROM leveranciers WHERE levid = :levid");
        $stmt->bindParam(':levid', $levid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            ?>
            <form method="post" action="">
                <input type="hidden" name="levid" value="<?php echo $result['levid']; ?>">
                <label>Leverancier Naam:</label>
                <input type="text" name="levnaam" value="<?php echo $result['levnaam']; ?>" required><br><br>
                <label>Contactpersoon:</label>
                <input type="text" name="levcontact" value="<?php echo $result['levcontact']; ?>" required><br><br>
                <label>Email:</label>
                <input type="text" name="levemail" value="<?php echo $result['levemail']; ?>" required><br><br>
                <label>Adres:</label>
                <input type="text" name="levadres" value="<?php echo $result['levadres']; ?>" required><br><br>
                <label>Postcode:</label>
                <input type="text" name="levpostcode" value="<?php echo $result['levpostcode']; ?>" required><br><br>
                <label>Woonplaats:</label>
                <input type="text" name="levwoonplaats" value="<?php echo $result['levwoonplaats']; ?>" required><br><br>
                <input type="submit" name="update" value="Leverancier bijwerken">
            </form>
            <?php
        } else {
            echo "Geen leverancier gevonden.";
        }
    }
    ?>

    <br>
    <a href="form_insert_leveranciers.php" class="button">Leverancier Toevoegen</a>
    <br><br>
    <a href="Index.php" class="button">Terug naar Homepage</a>
</body>
</html>
