<?php
include 'conn.php';
include 'Config.php';

class Verkooporder extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getVerkooporder($verkordid) {
        try {
            $query = "SELECT verkordid, artid, klantid, verkorddatum, verkordbestaantal, verkordstatus FROM verkooporders WHERE verkordid = :verkordid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':verkordid', $verkordid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de verkooporder: " . $e->getMessage();
        }
    }
}

$verkordid = $_GET['verkordid'] ?? '';
$verkooporder = new Verkooporder($conn);

// Zoekbalk logica
if (isset($_POST['search'])) {
    $verkordid = $_POST['verkordid'] ?? '';
    $verkooporderData = $verkooporder->getVerkooporder($verkordid);

    if ($verkooporderData) {
        echo "Verkooporder ID: " . $verkooporderData['verkordid'] . "<br>";
        echo "Artikel ID: " . $verkooporderData['artid'] . "<br>";
        echo "Klant ID: " . $verkooporderData['klantid'] . "<br>";
        echo "Verkoopdatum: " . $verkooporderData['verkorddatum'] . "<br>";
        echo "Besteld aantal: " . $verkooporderData['verkordbestaantal'] . "<br>";
        echo "Status: " . $verkooporderData['verkordstatus'] . "<br>";
    } else {
        echo "Verkooporder met ID $verkordid niet gevonden.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <form method="POST" action="">
        <input type="text" name="verkordid" placeholder="Verkooporder ID">
        <input type="submit" name="search" value="Zoeken">
    </form>

    <br>

    <a href='index.php'>Terug naar homepage</a>
</body>
</html>
