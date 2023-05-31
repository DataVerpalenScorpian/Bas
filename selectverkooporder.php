<?php
include 'conn.php';
include 'Config.php';

class Verkooporder extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getVerkooporders() {
        try {
            $query = "SELECT verkordid, artid, klantid, verkorddatum, verkordbestaantal, verkordstatus FROM verkooporders";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van verkooporders: " . $e->getMessage();
        }
    }
}

$verkooporder = new Verkooporder($conn);
$verkooporders = $verkooporder->getVerkooporders();

// Results
foreach ($verkooporders as $order) {
    echo "Verkooporder ID: " . $order['verkordid'] . "<br>";
    echo "Artikel ID: " . $order['artid'] . "<br>";
    echo "Klant ID: " . $order['klantid'] . "<br>";
    echo "Verkoopdatum: " . $order['verkorddatum'] . "<br>";
    echo "Besteld aantal: " . $order['verkordbestaantal'] . "<br>";
    echo "Status: " . $order['verkordstatus'] . "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
}
?>

<!DOCTYPE html>
<html>
<body>
	<a href='index.php'>Terug naar homepage</a>

</body>
</html>
