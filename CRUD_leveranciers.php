<?php
include 'conn.php';
include 'Config.php';

class Leveranciers extends Config {
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $this->conn->connect_error);
        }
    }

    public function selectAllLeveranciers() {
        $sql = "SELECT * FROM leveranciers";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Leverancier ID</th><th>Leverancier Naam</th><th>Contactpersoon</th><th>Email</th><th>Adres</th><th>Postcode</th><th>Woonplaats</th><th>Acties</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['levid'] . "</td>";
                echo "<td>" . $row['levnaam'] . "</td>";
                echo "<td>" . $row['levcontact'] . "</td>";
                echo "<td>" . $row['levemail'] . "</td>";
                echo "<td>" . $row['levadres'] . "</td>";
                echo "<td>" . $row['levpostcode'] . "</td>";
                echo "<td>" . $row['levwoonplaats'] . "</td>";
                echo "<td><a href='?action=update&id=" . $row['levid'] . "'>Bijwerken</a> | <a href='?action=delete&id=" . $row['levid'] . "' onclick='return confirm(\"Weet je zeker dat je deze leverancier wilt verwijderen?\")'>Verwijderen</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Geen leveranciers gevonden.";
        }
    }

    public function updateLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats) {
        // Check for empty fields
        if (empty($levnaam) || empty($levcontact) || empty($levemail) || empty($levadres) || empty($levpostcode) || empty($levwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        $sql = "UPDATE leveranciers SET levnaam = '$levnaam', levcontact = '$levcontact', levemail = '$levemail', levadres = '$levadres', levpostcode = '$levpostcode', levwoonplaats = '$levwoonplaats' WHERE levid = $levid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Leverancier succesvol bijgewerkt.";
        } else {
            echo "Fout bij het bijwerken van de leverancier: " . $this->conn->error;
        }
    }

    public function deleteLeverancier($levid) {
        $sql = "DELETE FROM leveranciers WHERE levid = $levid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Leverancier succesvol verwijderd.";
        } else {
            echo "Fout bij het verwijderen van de leverancier: " . $this->conn->error;
        }
    }
}

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
        /* Add your CSS styles here */
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
        $sql = "SELECT * FROM leveranciers WHERE levid = $levid";
        $result = $leveranciers->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="">
                <input type="hidden" name="levid" value="<?php echo $row['levid']; ?>">
                <label>Leverancier Naam:</label>
                <input type="text" name="levnaam" value="<?php echo $row['levnaam']; ?>" required><br><br>
                <label>Contactpersoon:</label>
                <input type="text" name="levcontact" value="<?php echo $row['levcontact']; ?>" required><br><br>
                <label>Email:</label>
                <input type="text" name="levemail" value="<?php echo $row['levemail']; ?>" required><br><br>
                <label>Adres:</label>
                <input type="text" name="levadres" value="<?php echo $row['levadres']; ?>" required><br><br>
                <label>Postcode:</label>
                <input type="text" name="levpostcode" value="<?php echo $row['levpostcode']; ?>" required><br><br>
                <label>Woonplaats:</label>
                <input type="text" name="levwoonplaats" value="<?php echo $row['levwoonplaats']; ?>" required><br><br>
                <input type="submit" name="update" value="Leverancier bijwerken">
            </form>
            <?php
        } else {
            echo "Geen leverancier gevonden.";
        }
    }
    ?>

</body>
</html>
