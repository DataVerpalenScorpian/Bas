<?php
include 'conn.php';
include 'Config.php';

class Artikelen extends Config {
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $this->conn->connect_error);
        }
    }

    public function selectAllArtikelen() {
        $sql = "SELECT * FROM artikelen";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Artikel ID</th><th>Artikel Omschrijving</th><th>Artikel Inkoop</th><th>Artikel Verkoop</th><th>Artikel Voorraad</th><th>Artikel Minimale Voorraad</th><th>Artikel Maximale Voorraad</th><th>Artikel Locatie</th><th>Leverancier ID</th><th>Acties</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['artid'] . "</td>";
                echo "<td>" . $row['artikelenomschrijving'] . "</td>";
                echo "<td>" . $row['artinkoop'] . "</td>";
                echo "<td>" . $row['artverkoop'] . "</td>";
                echo "<td>" . $row['artvoorraad'] . "</td>";
                echo "<td>" . $row['artminvoorraad'] . "</td>";
                echo "<td>" . $row['artmaxvoorraad'] . "</td>";
                echo "<td>" . $row['artlocatie'] . "</td>";
                echo "<td>" . $row['levid'] . "</td>";
                echo "<td><a href='?action=update&id=" . $row['artid'] . "'>Bijwerken</a> | <a href='?action=delete&id=" . $row['artid'] . "' onclick='return confirm(\"Weet je zeker dat je dit artikel wilt verwijderen?\")'>Verwijderen</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Geen artikelen gevonden.";
        }
    }

    public function updateArtikel($artid, $artikelenomschrijving, $artinkoop, $artverkoop, $artvoorraad, $artminvoorraad, $artmaxvoorraad, $artlocatie, $levid) {
        // Check for empty fields
        if (empty($artikelenomschrijving) || empty($artinkoop) || empty($artverkoop) || empty($artvoorraad) || empty($artminvoorraad) || empty($artmaxvoorraad) || empty($artlocatie) || empty($levid)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        $sql = "UPDATE artikelen SET artikelenomschrijving = '$artikelenomschrijving', artinkoop = '$artinkoop', artverkoop = '$artverkoop', artvoorraad = '$artvoorraad', artminvoorraad = '$artminvoorraad', artmaxvoorraad = '$artmaxvoorraad', artlocatie = '$artlocatie', levid = '$levid' WHERE artid = $artid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Artikel succesvol bijgewerkt.";
        } else {
            echo "Fout bij het bijwerken van het artikel: " . $this->conn->error;
        }
    }

    public function deleteArtikel($artid) {
        $sql = "DELETE FROM artikelen WHERE artid = $artid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Artikel succesvol verwijderd.";
        } else {
            echo "Fout bij het verwijderen van het artikel: " . $this->conn->error;
        }
    }
}

// Create an instance of the Artikelen class
$artikelen = new Artikelen();

// Process the updated article data if submitted
if (isset($_POST['update'])) {
    $artid = $_POST['artid'];
    $artikelenomschrijving = $_POST['artikelenomschrijving'];
    $artinkoop = $_POST['artinkoop'];
    $artverkoop = $_POST['artverkoop'];
    $artvoorraad = $_POST['artvoorraad'];
    $artminvoorraad = $_POST['artminvoorraad'];
    $artmaxvoorraad = $_POST['artmaxvoorraad'];
    $artlocatie = $_POST['artlocatie'];
    $levid = $_POST['levid'];

    $artikelen->updateArtikel($artid, $artikelenomschrijving, $artinkoop, $artverkoop, $artvoorraad, $artminvoorraad, $artmaxvoorraad, $artlocatie, $levid);
}

// Process the deletion of an article if requested
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $artid = $_GET['id'];
    $artikelen->deleteArtikel($artid);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Artikelenbeheer</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h2>Artikelenbeheer</h2>

    <h3>Artikelenoverzicht</h3>
    <?php $artikelen->selectAllArtikelen(); ?>

    <h3>Artikel bijwerken</h3>
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
        $artid = $_GET['id'];
        $sql = "SELECT * FROM artikelen WHERE artid = $artid";
        $result = $artikelen->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="">
                <input type="hidden" name="artid" value="<?php echo $row['artid']; ?>">
                <label>Artikel Omschrijving:</label>
                <input type="text" name="artikelenomschrijving" value="<?php echo $row['artikelenomschrijving']; ?>" required><br><br>
                <label>Artikel Inkoop:</label>
                <input type="text" name="artinkoop" value="<?php echo $row['artinkoop']; ?>" required><br><br>
                <label>Artikel Verkoop:</label>
                <input type="text" name="artverkoop" value="<?php echo $row['artverkoop']; ?>" required><br><br>
                <label>Artikel Voorraad:</label>
                <input type="text" name="artvoorraad" value="<?php echo $row['artvoorraad']; ?>" required><br><br>
                <label>Artikel Minimale Voorraad:</label>
                <input type="text" name="artminvoorraad" value="<?php echo $row['artminvoorraad']; ?>" required><br><br>
                <label>Artikel Maximale Voorraad:</label>
                <input type="text" name="artmaxvoorraad" value="<?php echo $row['artmaxvoorraad']; ?>" required><br><br>
                <label>Artikel Locatie:</label>
                <input type="text" name="artlocatie" value="<?php echo $row['artlocatie']; ?>" required><br><br>
                <label>Lev ID:</label>
                <input type="text" name="levid" value="<?php echo $row['levid']; ?>" required><br><br>
                <input type="submit" name="update" value="Artikel bijwerken">
            </form>
            <?php
        } else {
            echo "Geen artikel gevonden.";
        }
    }
    ?>

</body>
</html>

