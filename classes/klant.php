<?php
class Klanten extends Config {
    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function selectAllKlanten() {
        try {
            $query = "SELECT * FROM klanten";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                echo "<table>";
                echo "<tr><th>Klant ID</th><th>Klantnaam</th><th>Klant E-mail</th><th>Klant Adres</th><th>Klant Postcode</th><th>Klant Woonplaats</th><th>Acties</th></tr>";

                foreach ($result as $row) {
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
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de klanten: " . $e->getMessage();
        }
    }

    public function insertKlant($klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats) {
        // Check for empty fields
        if (empty($klantnaam) || empty($klantemail) || empty($klantadres) || empty($klantpostcode) || empty($klantwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        try {
            $query = "INSERT INTO klanten (klantnaam, klantemail, klantadres, klantpostcode, klantwoonplaats) VALUES (:klantnaam, :klantemail, :klantadres, :klantpostcode, :klantwoonplaats)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':klantnaam', $klantnaam);
            $stmt->bindParam(':klantemail', $klantemail);
            $stmt->bindParam(':klantadres', $klantadres);
            $stmt->bindParam(':klantpostcode', $klantpostcode);
            $stmt->bindParam(':klantwoonplaats', $klantwoonplaats);
            $stmt->execute();

            echo "Klant succesvol toegevoegd.";
        } catch(PDOException $e) {
            echo "Fout bij het toevoegen van de klant: " . $e->getMessage();
        }
    }

    public function updateKlant($klantid, $klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats) {
        // Check for empty fields
        if (empty($klantnaam) || empty($klantemail) || empty($klantadres) || empty($klantpostcode) || empty($klantwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        try {
            $query = "UPDATE klanten SET klantnaam = :klantnaam, klantemail = :klantemail, klantadres = :klantadres, klantpostcode = :klantpostcode, klantwoonplaats = :klantwoonplaats WHERE klantid = :klantid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':klantnaam', $klantnaam);
            $stmt->bindParam(':klantemail', $klantemail);
            $stmt->bindParam(':klantadres', $klantadres);
            $stmt->bindParam(':klantpostcode', $klantpostcode);
            $stmt->bindParam(':klantwoonplaats', $klantwoonplaats);
            $stmt->bindParam(':klantid', $klantid);
            $stmt->execute();

            echo "Klant succesvol bijgewerkt.";
        } catch(PDOException $e) {
            echo "Fout bij het bijwerken van de klant: " . $e->getMessage();
        }
    }

    public function deleteKlant($klantid) {
        try {
            $query = "DELETE FROM klanten WHERE klantid = :klantid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':klantid', $klantid);
            $stmt->execute();

            echo "Klant succesvol verwijderd.";
        } catch(PDOException $e) {
            echo "Fout bij het verwijderen van de klant: " . $e->getMessage();
        }
    }
}
?>
