<?php
include 'conn.php';
include 'Config.php';

class Klanten extends Config {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $this->conn->connect_error);
        }
    }

    public function selectAllKlanten() {
        $sql = "SELECT * FROM klanten";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Klant ID</th><th>Klantnaam</th><th>Klant E-mail</th><th>Klant Adres</th><th>Klant Postcode</th><th>Klant Woonplaats</th><th>Acties</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['klantid'] . "</td>";
                echo "<td>" . $row['klantnaam'] . "</td>";
                echo "<td>" . $row['klantemail'] . "</td>";
                echo "<td>" . $row['klantadres'] . "</td>";
                echo "<td>" . $row['klantpostcode'] . "</td>";
                echo "<td>" . $row['klantwoonplaats'] . "</td>";
                echo "<td><a href='?action=update&id=" . $row['klantid'] . "'>Bijwerken</a> | <a href='?action=delete&id=" . $row['klantid'] . "' onclick='return confirm(\"Weet je zeker dat je deze klant wilt verwijderen?\")'>Verwijderen</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Geen klanten gevonden.";
        }
    }

    public function insertKlant($klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats) {
        // Controleer op lege velden
        if (empty($klantnaam) || empty($klantemail) || empty($klantadres) || empty($klantpostcode) || empty($klantwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        $sql = "INSERT INTO klanten (klantnaam, klantemail, klantadres, klantpostcode, klantwoonplaats) VALUES ('$klantnaam', '$klantemail', '$klantadres', '$klantpostcode', '$klantwoonplaats')";

        if ($this->conn->query($sql) === TRUE) {
            echo "Klant succesvol toegevoegd.";
        } else {
            echo "Fout bij het toevoegen van de klant: " . $this->conn->error;
        }
    }

    public function updateKlant($klantid, $klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats) {
        // Controleer op lege velden
        if (empty($klantnaam) || empty($klantemail) || empty($klantadres) || empty($klantpostcode) || empty($klantwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        $sql = "UPDATE klanten SET klantnaam = '$klantnaam', klantemail = '$klantemail', klantadres = '$klantadres', klantpostcode = '$klantpostcode', klantwoonplaats = '$klantwoonplaats' WHERE klantid = $klantid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Klant succesvol bijgewerkt.";
        } else {
            echo "Fout bij het bijwerken van de klant: " . $this->conn->error;
        }
    }

    public function deleteKlant($klantid) {
        $sql = "DELETE FROM klanten WHERE klantid = $klantid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Klant succesvol verwijderd.";
        } else {
            echo "Fout bij het verwijderen van de klant: " . $this->conn->error;
        }
    }
}
?>
