<?php
include 'conn.php';
include 'Config.php';

class Verkooporder extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getVerkooporderArtikel($verkordid) {
        try {
            $query = "SELECT v.verkordid, v.artid, v.klantid, v.verkorddatum, v.verkordbestaantal, v.verkordstatus, a.artid, a.artikelenomschrijving, a.artinkoop, a.artverkoop, a.artvoorraad, a.artminvoorraad, a.artmaxvoorraad, a.artlocatie, a.levid
                      FROM verkooporders v
                      INNER JOIN artikelen a ON v.artid = a.artid
                      WHERE v.verkordid = :verkordid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':verkordid', $verkordid);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de verkooporder: " . $e->getMessage();
        }
    }
}

$verkooporder = new Verkooporder($conn);

// Zoekbalk logica
if (isset($_POST['search'])) {
    $verkordid = $_POST['verkordid'] ?? '';
    $verkooporderArtikel = $verkooporder->getVerkooporderArtikel($verkordid);

    if (!empty($verkooporderArtikel)) {
        echo "<table border='1'>
                <tr>
                    <th>Verkooporder ID</th>
                    <th>Artikel ID</th>
                    <th>Klant ID</th>
                    <th>Datum</th>
                    <th>Aantal</th>
                    <th>Status</th>
                    <th>Artikelomschrijving</th>
                    <th>Inkoopprijs</th>
                    <th>Verkoopprijs</th>
                    <th>Voorraad</th>
                    <th>Minimale voorraad</th>
                    <th>Maximale voorraad</th>
                    <th>Locatie ID</th>
                    <th>Lev ID</th>
                </tr>";

        foreach ($verkooporderArtikel as $order) {
            echo "<tr>
                    <td>" . $order['verkordid'] . "</td>
                    <td>" . $order['artid'] . "</td>
                    <td>" . $order['klantid'] . "</td>
                    <td>" . $order['verkorddatum'] . "</td>
                    <td>" . $order['verkordbestaantal'] . "</td>
                    <td>" . $order['verkordstatus'] . "</td>
                    <td>" . $order['artikelenomschrijving'] . "</td>
                    <td>" . $order['artinkoop'] . "</td>
                    <td>" . $order['artverkoop'] . "</td>
                    <td>" . $order['artvoorraad'] . "</td>
                    <td>" . $order['artminvoorraad'] . "</td>
                    <td>" . $order['artmaxvoorraad'] . "</

td>
                    <td>" . $order['artlocatie'] . "</td>
                    <td>" . $order['levid'] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Geen artikelen gevonden voor de opgegeven verkooporder.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
<h1>Zoek artikelen per verkooporder</h1>
<form method="POST" action="">
    <label for="verkordid">Verkooporder ID:</label>
    <input type="text" name="verkordid" id="verkordid" required>
    <input type="submit" name="search" value="Zoeken">
</form>
<br>
<a href='index.php'>Terug naar homepage</a>
</body>
</html>