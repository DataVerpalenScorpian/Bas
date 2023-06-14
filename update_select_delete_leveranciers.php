<?php
include 'conn.php';
include 'Config.php';

class Leveranciers extends Config {
    private $conn;

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
            echo "<tr><th>Leverancier ID</th><th>Leverancier Naam</th><th>Leverancier Contact</th><th>Leverancier E-mail</th><th>Leverancier Adres</th><th>Leverancier Postcode</th><th>Leverancier Woonplaats</th><th>Acties</th></tr>";

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
        // Controleer op lege velden
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

    public function getLeverancierNaam($levid) {
        $sql = "SELECT levnaam FROM leveranciers WHERE levid = $levid";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['levnaam'];
        }

        return "";
    }

    public function getLeverancierContact($levid) {
        $sql = "SELECT levcontact FROM leveranciers WHERE levid = $levid";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['levcontact'];
        }

        return "";
    }

    public function getLeverancierEmail($levid) {
        $sql = "SELECT levemail FROM leveranciers WHERE levid = $levid";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['levemail'];
        }

        return "";
    }

    public function getLeverancierAdres($levid) {
        $sql = "SELECT levadres FROM leveranciers WHERE levid = $levid";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['levadres'];
        }

        return "";
    }

    public function getLeverancierPostcode($levid) {
        $sql = "SELECT levpostcode FROM leveranciers WHERE levid = $levid";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['levpostcode'];
        }

        return "";
    }

    public function getLeverancierWoonplaats($levid) {
        $sql = "SELECT levwoonplaats FROM leveranciers WHERE levid = $levid";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['levwoonplaats'];
        }

        return "";
    }

    public function addLeverancier($levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats) {
        // Controleer op lege velden
        if (empty($levnaam) || empty($levcontact) || empty($levemail) || empty($levadres) || empty($levpostcode) || empty($levwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        $sql = "INSERT INTO leveranciers (levnaam, levcontact, levemail, levadres, levpostcode, levwoonplaats) VALUES ('$levnaam', '$levcontact', '$levemail', '$levadres', '$levpostcode', '$levwoonplaats')";

        if ($this->conn->query($sql) === TRUE) {
            echo "Leverancier succesvol toegevoegd.";
        } else {
            echo "Fout bij het toevoegen van de leverancier: " . $this->conn->error;
        }
    }
}

// Formulier voor het toevoegen of bijwerken van een leverancier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $leveranciers = new Leveranciers();

    if (isset($_POST['add'])) {
        $levnaam = $_POST['levnaam'];
        $levcontact = $_POST['levcontact'];
        $levemail = $_POST['levemail'];
        $levadres = $_POST['levadres'];
        $levpostcode = $_POST['levpostcode'];
        $levwoonplaats = $_POST['levwoonplaats'];

        $leveranciers->addLeverancier($levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats);
    } elseif (isset($_POST['update'])) {
        $levid = $_POST['levid'];
        $levnaam = $_POST['levnaam'];
        $levcontact = $_POST['levcontact'];
        $levemail = $_POST['levemail'];
        $levadres = $_POST['levadres'];
        $levpostcode = $_POST['levpostcode'];
        $levwoonplaats = $_POST['levwoonplaats'];

        $leveranciers->updateLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats);
    } elseif (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $levid = $_GET['id'];

        $leveranciers->deleteLeverancier($levid);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leveranciers</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
    <style>
    </style>
</head>
<body>
    <h2>Leveranciers</h2>

    <!-- Weergave van alle leveranciers -->
    <?php
    $leveranciers = new Leveranciers();
    $leveranciers->selectAllLeveranciers();
    ?>

    <!-- Formulier voor het toevoegen of bijwerken van een leverancier -->
    <h3>Leverancier toevoegen/bijwerken</h3>
    <form method="post" action="">
        <input type="hidden" name="levid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
        <label for="levnaam">Naam:</label>
        <input type="text" name="levnaam" value="<?php echo isset($_GET['id']) ? $leveranciers->getLeverancierNaam($_GET['id']) : ''; ?>"><br><br>
        <label for="levcontact">Contact:</label>
        <input type="text" name="levcontact" value="<?php echo isset($_GET['id']) ? $leveranciers->getLeverancierContact($_GET['id']) : ''; ?>"><br><br>
        <label for="levemail">E-mail:</label>
        <input type="email" name="levemail" value="<?php echo isset($_GET['id']) ? $leveranciers->getLeverancierEmail($_GET['id']) : ''; ?>"><br><br>
        <label for="levadres">Adres:</label>
        <input type="text" name="levadres" value="<?php echo isset($_GET['id']) ? $leveranciers->getLeverancierAdres($_GET['id']) : ''; ?>"><br><br>
        <label for="levpostcode">Postcode:</label>
        <input type="text" name="levpostcode" value="<?php echo isset($_GET['id']) ? $leveranciers->getLeverancierPostcode($_GET['id']) : ''; ?>"><br><br>
        <label for="levwoonplaats">Woonplaats:</label>
        <input type="text" name="levwoonplaats" value="<?php echo isset($_GET['id']) ? $leveranciers->getLeverancierWoonplaats($_GET['id']) : ''; ?>"><br><br>
        <?php if (isset($_GET['id'])): ?>
            <input type="submit" name="update" value="Bijwerken">
    </form>
</body>
</html>
