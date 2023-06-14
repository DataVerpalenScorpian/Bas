<?php
include 'conn.php';
include 'Config.php';

class Leveranciers extends Config {

    public function insertLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $conn->connect_error);
        }

        // Controleer op lege velden
        if (empty($levid) || empty($levnaam) || empty($levcontact) || empty($levemail) || empty($levadres) || empty($levpostcode) || empty($levwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        $sql = "INSERT INTO leveranciers (levid, levnaam, levcontact, levemail, levadres, levpostcode, levwoonplaats) VALUES ('$levid', '$levnaam', '$levcontact', '$levemail', '$levadres', '$levpostcode', '$levwoonplaats')";

        if ($conn->query($sql) === TRUE) {
            echo "Leverancier succesvol toegevoegd. Leverancier ID: " . $levid;
        } else {
            echo "Fout bij het toevoegen van de leverancier: " . $conn->error;
        }

        $conn->close();
    }
}

$leveranciers = new Leveranciers();

if (isset($_POST['insert'])) {
    $artid = $_POST['artid'] ?? '';
    $levid = $_POST['levid'] ?? '';
    $inkorddatum = $_POST['inkorddatum'] ?? '';
    $inkordbestaantal = $_POST['inkordbestaantal'] ?? '';
    $inkordstatus = $_POST['inkordstatus'] ?? '';

    $leveranciers->insert($artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus);
}

if (isset($_POST['insertLeverancier'])) {
    $levid = $_POST['levid'] ?? '';
    $levnaam = $_POST['levnaam'] ?? '';
    $levcontact = $_POST['levcontact'] ?? '';
    $levemail = $_POST['levemail'] ?? '';
    $levadres = $_POST['levadres'] ?? '';
    $levpostcode = $_POST['levpostcode'] ?? '';
    $levwoonplaats = $_POST['levwoonplaats'] ?? '';

    $leveranciers->insertLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats);
}
?>
