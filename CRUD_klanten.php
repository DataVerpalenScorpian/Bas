<?php
include 'conn.php';
include 'Config.php';

class Klanten extends Config {
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $this->conn->connect_error);
        }
    }

    public function selectAllKlanten() {
        $sql = "SELECT * FROM klanten";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Klant ID</th><th>Klantnaam</th><th>Klant E-mail</th><th>Klant Adres</th><th>Klant Postcode</th><th>Klant Woonplaats</th><th>Acties</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['klantid'] . "</td>";
                echo "<td>" . $row['klantnaam'] . "</td>";
                echo "<td>" . $row['klantemail'] . "</td>";
                echo "<td>" . $row['klantadres'] . "</td>";
                echo "<td>" . $row['klantpostcode'] . "</td>";
                echo "<td>" . $row['klantwoonplaats'] . "</td>";
                echo "<td><a href='?action=update&id=" . $row['klantid'] . "'>Bijwerken</a> | <a href='?action=delete&id=" . $row['klantid'] . "' onclick='return confirm(\"Weet je zeker dat je deze klant wilt verwijderen?\")'>Verwijderen</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Geen klanten gevonden.";
        }
    }

    public function insertKlant($klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats) {
        // Check for empty fields
        if (empty($klantnaam) || empty($klantemail) || empty($klantadres) || empty($klantpostcode) || empty($klantwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        $sql = "INSERT INTO klanten (klantnaam, klantemail, klantadres, klantpostcode, klantwoonplaats) VALUES ('$klantnaam', '$klantemail', '$klantadres', '$klantpostcode', '$klantwoonplaats')";

        if ($this->conn->query($sql) === TRUE) {
            echo "Klant succesvol toegevoegd.";
        } else {
            echo "Fout bij het toevoegen van de klant: " . $this->conn->error;
        }
    }

    public function updateKlant($klantid, $klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats) {
        // Check for empty fields
        if (empty($klantnaam) || empty($klantemail) || empty($klantadres) || empty($klantpostcode) || empty($klantwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        $sql = "UPDATE klanten SET klantnaam = '$klantnaam', klantemail = '$klantemail', klantadres = '$klantadres', klantpostcode = '$klantpostcode', klantwoonplaats = '$klantwoonplaats' WHERE klantid = $klantid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Klant succesvol bijgewerkt.";
        } else {
            echo "Fout bij het bijwerken van de klant: " . $this->conn->error;
        }
    }

    public function deleteKlant($klantid) {
        $sql = "DELETE FROM klanten WHERE klantid = $klantid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Klant succesvol verwijderd.";
        } else {
            echo "Fout bij het verwijderen van de klant: " . $this->conn->error;
        }
    }
}

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
        /* Add your CSS styles here */
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
        <input type="submit" name="submit" value="Klant toevoegen">
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
                <input type="submit" name="update" value="Klant bijwerken">
            </form>
            <?php
        } else {
            echo "Geen klant gevonden.";
        }
    }
    ?>

</body>
</html>
