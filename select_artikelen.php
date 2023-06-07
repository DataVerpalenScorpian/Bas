<?php
include 'conn.php';
include 'Config.php';

class Artikelen extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getArtikelen() {
        try {
            $query = "SELECT artid, artikelenomschrijving, artinkoop, artverkoop, artvoorraad, artminvoorraad, artmaxvoorraad, artlocatie, levid FROM artikelen";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de artikelen: " . $e->getMessage();
        }
    }
}

$artikelen = new Artikelen($conn);

// Artikelen ophalen
$artikelData = $artikelen->getArtikelen();
?>

<!DOCTYPE html>
<html>
<body>
<h1>Artikelen weergeven</h1>

<?php if (!empty($artikelData)) { ?>
    <table border='1'>
        <tr>
            <th>Artikel ID</th>
            <th>Omschrijving</th>
            <th>Inkoop</th>
            <th>Verkoop</th>
            <th>Voorraad</th>
            <th>Minimale Voorraad</th>
            <th>Maximale Voorraad</th>
            <th>Locatie</th>
            <th>Lev ID</th>
        </tr>
        <?php foreach ($artikelData as $artikel) { ?>
            <tr>
                <td><?php echo $artikel['artid']; ?></td>
                <td><?php echo $artikel['artikelenomschrijving']; ?></td>
                <td><?php echo $artikel['artinkoop']; ?></td>
                <td><?php echo $artikel['artverkoop']; ?></td>
                <td><?php echo $artikel['artvoorraad']; ?></td>
                <td><?php echo $artikel['artminvoorraad']; ?></td>
                <td><?php echo $artikel['artmaxvoorraad']; ?></td>
                <td><?php echo $artikel['artlocatie']; ?></td>
                <td><?php echo $artikel['levid']; ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else {
    echo "Geen artikelen gevonden.";
} ?>

<br>

<a href='index.php'>Terug naar homepage</a>
</body>
</html>
