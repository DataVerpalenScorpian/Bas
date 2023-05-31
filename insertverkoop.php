<?php
include 'conn.php';
include 'Config.php';

class Verkooporder extends Config {

    public function insert($artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $conn->connect_error);
        }

        // Controleer op lege velden
        if (empty($artid) || empty($klantid) || empty($verkorddatum) || empty($verkordbestaantal) || empty($verkordstatus)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        // Controleer of numerieke waarden correct zijn
        if (!is_numeric($artid) || !is_numeric($klantid) || !is_numeric($verkordbestaantal)) {
            echo "Fout: Ongeldige numerieke waarden voor velden.";
            return;
        }

        $sql = "SELECT klantid FROM verkooporders WHERE klantid = '$klantid'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "Fout: Klant met ID $klantid bestaat al.";
            return;
        }

        $sql = "INSERT INTO verkooporders (artid, klantid, verkorddatum, verkordbestaantal, verkordstatus) VALUES ('$artid', '$klantid', '$verkorddatum', '$verkordbestaantal', '$verkordstatus')";

        try {
            if ($conn->query($sql) === TRUE) {
                $verkordid = $conn->insert_id; // Haal het ingevoegde verkordid op
                echo "Verkooporder succesvol toegevoegd. Verkooporder ID: " . $verkordid;
            } else {
                echo "Fout bij het toevoegen van de verkooporder: " . $conn->error;
            }
        } catch (mysqli_sql_exception $e) {
            // Handle duplicate entry error
            if ($e->getCode() === 1062) {
                echo "Fout: De verkooporder met het opgegeven artikel ID bestaat al.";
                return;
            }

            // Handle other exceptions
            echo "Fout bij het toevoegen van de verkooporder: " . $e->getMessage();
        }

        $conn->close();
    }
}

if (isset($_POST['insert'])) {
    $artid = $_POST['artid'] ?? '';
    $klantid = $_POST['klantid'] ?? '';
    $verkorddatum = $_POST['verkorddatum'] ?? '';
    $verkordbestaantal = $_POST['verkordbestaantal'] ?? '';
    $verkordstatus = $_POST['verkordstatus'] ?? '';

    $verkooporder = new Verkooporder();
    $verkooporder->insert($artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus);
}
?>
