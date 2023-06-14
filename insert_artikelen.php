<?php
include 'conn.php';
include 'Config.php';

class Artikelen extends Config {

    public function insert($artid, $artikelenomschrijving, $artinkoop, $artverkoop, $artvoorraad, $artminvoorraad, $artmaxvoorraad, $artlocatie, $levid) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $conn->connect_error);
        }

        $errorFields = [];

        // Controleer op lege velden
        if (empty($artid)) {
            $errorFields[] = 'artid';
        }
        if (empty($artikelenomschrijving)) {
            $errorFields[] = 'artikelenomschrijving';
        }
        if (empty($artinkoop)) {
            $errorFields[] = 'artinkoop';
        }
        if (empty($artverkoop)) {
            $errorFields[] = 'artverkoop';
        }
        if (empty($artvoorraad)) {
            $errorFields[] = 'artvoorraad';
        }
        if (empty($artminvoorraad)) {
            $errorFields[] = 'artminvoorraad';
        }
        if (empty($artmaxvoorraad)) {
            $errorFields[] = 'artmaxvoorraad';
        }
        if (empty($artlocatie)) {
            $errorFields[] = 'artlocatie';
        }
        if (empty($levid)) {
            $errorFields[] = 'levid';
        }

        if (!empty($errorFields)) {
            echo "Fout: Alle velden moeten worden ingevuld. Ontbrekende velden: " . implode(', ', $errorFields);
            return;
        }

        // Controleer of numerieke waarden correct zijn
        if (!is_numeric($artid)) {
            $errorFields[] = 'artid';
        }
        if (!is_numeric($artinkoop)) {
            $errorFields[] = 'artinkoop';
        }
        if (!is_numeric($artverkoop)) {
            $errorFields[] = 'artverkoop';
        }
        if (!is_numeric($artvoorraad)) {
            $errorFields[] = 'artvoorraad';
        }
        if (!is_numeric($artminvoorraad)) {
            $errorFields[] = 'artminvoorraad';
        }
        if (!is_numeric($artmaxvoorraad)) {
            $errorFields[] = 'artmaxvoorraad';
        }
        if (!is_numeric($levid)) {
            $errorFields[] = 'levid';
        }

        if (!empty($errorFields)) {
            echo "Fout: Ongeldige numerieke waarden voor velden. Ongeldige velden: " . implode(', ', $errorFields);
            return;
        }

        $sql = "INSERT INTO artikelen (artid, artikelenomschrijving, artinkoop, artverkoop, artvoorraad, artminvoorraad, artmaxvoorraad, artlocatie, levid) VALUES ('$artid', '$artikelenomschrijving', '$artinkoop', '$artverkoop', '$artvoorraad', '$artminvoorraad', '$artmaxvoorraad', '$artlocatie', '$levid')";

        if ($conn->query($sql) === TRUE) {
            echo "Artikel succesvol toegevoegd.";
        } else {
            echo "Fout bij het toevoegen van het artikel: " . $conn->error;
        }

        $conn->close();
    }

    // Rest van de code...

}

$artikelen = new Artikelen();

if (isset($_POST['insert'])) {
    $artid = $_POST['artid'] ?? '';
    $artikelenomschrijving = $_POST['artikelenomschrijving'] ?? '';
    $artinkoop = $_POST['artinkoop'] ?? '';
    $artverkoop = $_POST['artverkoop'] ?? '';
    $artvoorraad = $_POST['artvoorraad'] ?? '';
    $artminvoorraad = $_POST['artminvoorraad'] ?? '';
    $artmaxvoorraad = $_POST['artmaxvoorraad'] ?? '';
    $artlocatie = $_POST['artlocatie'] ?? '';
    $levid = $_POST['levid'] ?? '';

    $artikelen->insert($artid, $artikelenomschrijving, $artinkoop, $artverkoop, $artvoorraad, $artminvoorraad, $artmaxvoorraad, $artlocatie, $levid);
}
?>
