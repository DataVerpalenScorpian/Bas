<?php
include 'conn.php';
include 'Config.php';

class Verkooporder extends Config {

    public function insert($artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus) {
    
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

            $sql = "SELECT klantid FROM verkooporders WHERE klantid = :klantid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':klantid', $klantid);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Fout: Klant met ID $klantid bestaat al.";
                return;
            }

            $sql = "INSERT INTO verkooporders (artid, klantid, verkorddatum, verkordbestaantal, verkordstatus) VALUES (:artid, :klantid, :verkorddatum, :verkordbestaantal, :verkordstatus)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':artid', $artid);
            $stmt->bindParam(':klantid', $klantid);
            $stmt->bindParam(':verkorddatum', $verkorddatum);
            $stmt->bindParam(':verkordbestaantal', $verkordbestaantal);
            $stmt->bindParam(':verkordstatus', $verkordstatus);

            if ($stmt->execute()) {
                $verkordid = $conn->lastInsertId();
                echo "Verkooporder succesvol toegevoegd. Verkooporder ID: " . $verkordid;
            } else {
                echo "Fout bij het toevoegen van de verkooporder: " . $stmt->errorInfo()[2];
            }

        } catch (PDOException $e) {
            // Handle duplicate entry error
            if ($e->getCode() === '23000') {
                echo "Fout: De verkooporder met het opgegeven artikel ID bestaat al.";
                return;
            }

            // Handle other exceptions
            echo "Fout bij het toevoegen van de verkooporder: " . $e->getMessage();
        }

        $conn = null;
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
