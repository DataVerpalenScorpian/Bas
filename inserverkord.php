<?php
include 'conn.php';
include 'Config.php';

class Verkooporder extends Config {

    public function insert($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $conn->connect_error);
        }

        // Controleer op lege velden
        if (empty($verkordid) || empty($artid) || empty($klantid) || empty($verkorddatum) || empty($verkordbestaantal) || empty($verkordstatus)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        // Controleer of numerieke waarden correct zijn
        if (!is_numeric($verkordid) || !is_numeric($artid) || !is_numeric($klantid) || !is_numeric($verkordbestaantal)) {
            echo "Fout: Ongeldige numerieke waarden voor velden.";
            return;
        }

        $sql = "INSERT INTO verkooporders (verkordid, artid, klantid, verkorddatum, verkordbestaantal, verkordstatus) VALUES ('$verkordid', '$artid', '$klantid', '$verkorddatum', '$verkordbestaantal', '$verkordstatus')";

        if ($conn->query($sql) === TRUE) {
            $verkordid = $conn->insert_id; // Haal het ingevoegde verkordid op
            echo "Verkooporder succesvol toegevoegd. Verkooporder ID: " . $verkordid;
        } else {
            echo "Fout bij het toevoegen van de verkooporder: " . $conn->error;
        }

        $conn->close();
    }
}

if (isset($_POST['insert'])) {
    $verkordid = $_POST['verkordid'] ?? '';
    $artid = $_POST['artid'] ?? '';
    $klantid = $_POST['klantid'] ?? '';
    $verkorddatum = $_POST['verkorddatum'] ?? '';
    $verkordbestaantal = $_POST['verkordbestaantal'] ?? '';
    $verkordstatus = $_POST['verkordstatus'] ?? '';

    $verkooporder = new Verkooporder();
    $verkooporder->insert($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus);
}
?>
