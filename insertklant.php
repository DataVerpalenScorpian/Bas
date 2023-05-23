<?php
include 'conn.php';

class Klant {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "basdb";

    public function insert($klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $conn->connect_error);
        }

        $sql = "INSERT INTO klanten (klantnaam, klantemail, klantadres, klantpostcode, klantwoonplaats) VALUES ('$klantnaam', '$klantemail', '$klantadres', '$klantpostcode', '$klantwoonplaats')";

        if ($conn->query($sql) === TRUE) {
            $klantid = $conn->insert_id; // Haal het ingevoegde klantid op
            echo "Klant succesvol toegevoegd. Klant ID: " . $klantid;
        } else {
            echo "Fout bij het toevoegen van de klant: " . $conn->error;
        }

        $conn->close();
    }
}

if (isset($_POST['insert'])) {
    $klantnaam = $_POST['klantnaam'];
    $klantemail = $_POST['klantemail'];
    $klantadres = $_POST['klantadres'];
    $klantpostcode = $_POST['klantpostcode'];
    $klantwoonplaats = $_POST['klantwoonplaats'];

    $klant = new Klant();
    $klant->insert($klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats);
}
?>
