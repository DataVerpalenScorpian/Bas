<?php
include 'conn.php';
include 'Config.php';

class KlantInsert extends Config {

    public function insert($klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats) {
        $dsn = "mysql:host={$this->servername};dbname={$this->dbname}";
        $username = $this->username;
        $password = $this->password;

        try {
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO klanten (klantnaam, klantemail, klantadres, klantpostcode, klantwoonplaats) 
                    VALUES (:klantnaam, :klantemail, :klantadres, :klantpostcode, :klantwoonplaats)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':klantnaam', $klantnaam);
            $stmt->bindParam(':klantemail', $klantemail);
            $stmt->bindParam(':klantadres', $klantadres);
            $stmt->bindParam(':klantpostcode', $klantpostcode);
            $stmt->bindParam(':klantwoonplaats', $klantwoonplaats);

            if ($stmt->execute()) {
                $klantid = $conn->lastInsertId(); // Haal het ingevoegde klantid op
                echo "Klant succesvol toegevoegd. Klant ID: " . $klantid;
            } else {
                echo "Fout bij het toevoegen van de klant: " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            die("Kan geen verbinding maken met de database: " . $e->getMessage());
        }

        $conn = null;
    }
}

if (isset($_POST['insert'])) {
    $klantnaam = $_POST['klantnaam'];
    $klantemail = $_POST['klantemail'];
    $klantadres = $_POST['klantadres'];
    $klantpostcode = $_POST['klantpostcode'];
    $klantwoonplaats = $_POST['klantwoonplaats'];

    $klantInsert = new KlantInsert();
    $klantInsert->insert($klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats);
}
?>
