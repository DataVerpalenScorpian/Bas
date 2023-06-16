<?php
include 'conn.php';
include 'Config.php';

class ZoekKlant extends Config {

    public function __construct() {
        $this->handleSearchRequest();
    }

    private function handleSearchRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['klantid'])) {
            $klantid = $_GET['klantid'];

            try {
                $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT * FROM klanten WHERE klantid = :klantid");
                $stmt->bindParam(':klantid', $klantid);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $this->displayCustomerData($result);
                } else {
                    echo "<p>Klant niet gevonden.</p>";
                }
            } catch(PDOException $e) {
                echo "Fout: " . $e->getMessage();
            }

            $conn = null;
        }
    }

    private function displayCustomerData($customerData) {
        echo "<h2>Klantgegevens</h2>";
        echo "<p>Klant ID: " . $customerData['klantid'] . "</p>";
        echo "<p>Klantnaam: " . $customerData['klantnaam'] . "</p>";
        echo "<p>Email: " . $customerData['klantemail'] . "</p>";
        echo "<p>Adres: " . $customerData['klantadres'] . "</p>";
        echo "<p>Postcode: " . $customerData['klantpostcode'] . "</p>";
        echo "<p>Woonplaats: " . $customerData['klantwoonplaats'] . "</p>";
    }
}

$searchCustomer = new ZoekKlant();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zoeken op klant ID</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
</head>
<body>
    <h1>Zoeken op klant ID</h1>

    <form method="GET" action="">
        <label for="klantid">Klant ID:</label>
        <input type="text" name="klantid" id="klantid">
        <input type="submit" value="Zoeken">
    </form>
    <br><br>
    <a href="CRUD_klanten.php" class="button">Klantbeheer</a>
    <br><br>
    <a href="Index.php" class="button">Terug naar Homepage</a>
</body>
</html>
