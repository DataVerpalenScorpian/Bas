<?php
include 'conn.php';
include 'Config.php';
include 'classes.php';

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
        $sql = "SELECT * FROM klanten WHERE klantid = $klantid";
        $result = $klanten->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="">
                <input type="hidden" name="klantid" value="<?php echo $row['klantid']; ?>">
                <label>Klantnaam:</label>
                <input type="text" name="klantnaam" value="<?php echo $row['klantnaam']; ?>" required><br><br>
                <label>Klant E-mail:</label>
                <input type="email" name="klantemail" value="<?php echo $row['klantemail']; ?>" required><br><br>
                <label>Klant Adres:</label>
                <input type="text" name="klantadres" value="<?php echo $row['klantadres']; ?>" required><br><br>
                <label>Klant Postcode:</label>
                <input type="text" name="klantpostcode" value="<?php echo $row['klantpostcode']; ?>" required><br><br>
                <label>Klant Woonplaats:</label>
                <input type="text" name="klantwoonplaats" value="<?php echo $row['klantwoonplaats']; ?>" required><br><br>
                <input type="submit" name="update" value="Klant bijwerken" class="button">
            </form>
            <?php
        } else {
            echo "Geen klant gevonden.";
        }
    }
    ?>

</body>
</html>

