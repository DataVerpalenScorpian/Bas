<?php
include 'conn.php';

class Verkord {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "basdb";

    public function insert($verkorddatum, $verkordbestaantal, $verkordstatus) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $conn->connect_error);
        }

        $sql = "INSERT INTO verkooporders (verkorddatum, verkordbestaantal, verkordstatus) VALUES ('$verkorddatum', '$verkordbestaantal', '$verkordstatus')";

        if ($conn->query($sql) === TRUE) {
            $verkordid = $conn->insert_id; // Haal het ingevoegde verkordid op
            echo "Verkord succesvol toegevoegd. Verkord ID: " . $verkordid;
        } else {
            echo "Fout bij het toevoegen van de verkord: " . $conn->error;
        }

        $conn->close();
    }
}

if (isset($_POST['insert'])) {
    $verkorddatum = $_POST['verkorddatum'];
    $verkordbestaantal = $_POST['verkordbestaantal'];
    $verkordstatus = $_POST['verkordstatus'];

    $verkord = new Verkord();
    $verkord->insert($verkorddatum, $verkordbestaantal, $verkordstatus);
}
?>
