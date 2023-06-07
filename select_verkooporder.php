<?php
include 'conn.php';
include 'Config.php';

class Verkooporder extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getVerkoopordersByKlantId($klantid) {
        try {
            $query = "SELECT v.verkordid, v.artid, v.klantid, v.verkorddatum, v.verkordbestaantal, v.verkordstatus, a.artikelenomschrijving
                      FROM verkooporders v
                      INNER JOIN artikelen a ON v.artid = a.artId
                      WHERE v.klantid = :klantid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':klantid', $klantid);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de verkooporders: " . $e->getMessage();
        }
    }

    public function getKlanten() {
        try {
            $query = "SELECT klantId, klantNaam FROM klanten";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de klanten: " . $e->getMessage();
        }
    }
}

$verkooporder = new Verkooporder($conn);

// Zoekbalk logica
if (isset($_POST['search'])) {
    $klantid = $_POST['klantid'] ?? '';
    $verkooporders = $verkooporder->getVerkoopordersByKlantId($klantid);

    if (!empty($verkooporders)) {
        echo "<table border='1'>
                <tr>
                    <th>Order ID</th>
                    <th>Artikel ID</th>
                    <th>Klant ID</th>
                    <th>Datum</th>
                    <th>Aantal</th>
                    <th>Status</th>
                    <th>Artikelomschrijving</th>
                </tr>";
        
        foreach ($verkooporders as $verkooporderData) {
            echo "<tr>
                    <td>" . $verkooporderData['verkordid'] . "</td>
                    <td>" . $verkooporderData['artid'] . "</td>
                    <td>" . $verkooporderData['klantid'] . "</td>
                    <td>" . $verkooporderData['verkorddatum'] . "</td>
                    <td>" . $verkooporderData['verkordbestaantal'] . "</td>
                    <td>" . $verkooporderData['verkordstatus'] . "</td>
                    <td>" . $verkooporderData['artikelenomschrijving'] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Geen verkooporders gevonden voor de geselecteerde klant.";
    }
}

// Klant selectie
$klanten = $verkooporder->getKlanten();
?>

<!DOCTYPE html>
<html>
<body>
<h1>Verkooporder zoeken met behulp van de klantnaam</h1>

<form method="POST" action="">
    <label for="klantid">Klant:</label>
    <select name="klantid" id="klantid" required>
        <?php foreach ($klanten as $klant) { ?>
            <option value="<?php echo $klant['klantId']; ?>"><?php echo $klant['klantNaam']; ?></option>
        <?php } ?>
    </select>
    <br><br>
    <input type="submit" name="search" value="Search">
</form>

<br>

<a href='index.php'>Terug naar homepage</a>
</body>
</html>

