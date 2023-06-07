<?php
include 'conn.php';
include 'Config.php';

class Inkooporder extends Config {

    public function insert($artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $conn->connect_error);
        }

        // Controleer op lege velden
        if (empty($artid) || empty($levid) || empty($inkorddatum) || empty($inkordbestaantal) || empty($inkordstatus)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        // Controleer of numerieke waarden correct zijn
        if (!is_numeric($artid) || !is_numeric($levid) || !is_numeric($inkordbestaantal)) {
            echo "Fout: Ongeldige numerieke waarden voor velden.";
            return;
        }

        $sql = "INSERT INTO inkooporders (inkordid, artid, levid, inkorddatum, inkordbestaantal, inkordstatus) VALUES (NULL, '$artid', '$levid', '$inkorddatum', '$inkordbestaantal', '$inkordstatus')";

        if ($conn->query($sql) === TRUE) {
            $inkordid = $conn->insert_id; // Haal het ingevoegde inkordid op
            echo "Inkooporder succesvol toegevoegd. Inkooporder ID: " . $inkordid;
        } else {
            echo "Fout bij het toevoegen van de inkooporder: " . $conn->error;
        }

        $conn->close();
    }

    public function getArtikelDropdown() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $conn->connect_error);
        }

        $sql = "SELECT a.artid, a.artikelenomschrijving 
                FROM artikelen AS a";
        $result = $conn->query($sql);

        $dropdown = '<select name="artid">';
        while ($row = $result->fetch_assoc()) {
            $artid = $row['artid'];
            $artikelomschrijving = $row['artikelenomschrijving'];
            $dropdown .= "<option value=\"$artid\">$artid - $artikelomschrijving</option>";
        }
        $dropdown .= '</select>';

        $conn->close();

        return $dropdown;
    }

    public function getLeverancierDropdown() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $conn->connect_error);
        }

        $sql = "SELECT l.levid, l.levnaam FROM leveranciers AS l";
        $result = $conn->query($sql);

        $dropdown = '<select name="levid">';
        while ($row = $result->fetch_assoc()) {
            $levid = $row['levid'];
            $levnaam = $row['levnaam'];
            $dropdown .= "<option value=\"$levid\">$levid - $levnaam</option>";
        }
        $dropdown .= '</select>';

        $conn->close();

        return $dropdown;
    }
}

$inkooporder = new Inkooporder();

if (isset($_POST['insert'])) {
    $artid = $_POST['artid'] ?? '';
    $levid = $_POST['levid'] ?? '';
    $inkorddatum = $_POST['inkorddatum'] ?? '';
    $inkordbestaantal = $_POST['inkordbestaantal'] ?? '';
    $inkordstatus = $_POST['inkordstatus'] ?? '';

    $inkooporder->insert($artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus);
}
?>

