<?php
class Klanten extends Config {
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
        // Check for empty fields
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
        // Check for empty fields
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

class Artikelen extends Config {
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $this->conn->connect_error);
        }
    }

    public function selectAllArtikelen() {
        $sql = "SELECT * FROM artikelen";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Artikel ID</th><th>Artikel Omschrijving</th><th>Artikel Inkoop</th><th>Artikel Verkoop</th><th>Artikel Voorraad</th><th>Artikel Minimale Voorraad</th><th>Artikel Maximale Voorraad</th><th>Artikel Locatie</th><th>Leverancier ID</th><th>Acties</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['artid'] . "</td>";
                echo "<td>" . $row['artikelenomschrijving'] . "</td>";
                echo "<td>" . $row['artinkoop'] . "</td>";
                echo "<td>" . $row['artverkoop'] . "</td>";
                echo "<td>" . $row['artvoorraad'] . "</td>";
                echo "<td>" . $row['artminvoorraad'] . "</td>";
                echo "<td>" . $row['artmaxvoorraad'] . "</td>";
                echo "<td>" . $row['artlocatie'] . "</td>";
                echo "<td>" . $row['levid'] . "</td>";
                echo "<td><a href='?action=update&id=" . $row['artid'] . "'>Bijwerken</a> | <a href='?action=delete&id=" . $row['artid'] . "' onclick='return confirm(\"Weet je zeker dat je dit artikel wilt verwijderen?\")'>Verwijderen</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Geen artikelen gevonden.";
        }
    }

    public function updateArtikel($artid, $artikelenomschrijving, $artinkoop, $artverkoop, $artvoorraad, $artminvoorraad, $artmaxvoorraad, $artlocatie, $levid) {
        // Check for empty fields
        if (empty($artikelenomschrijving) || empty($artinkoop) || empty($artverkoop) || empty($artvoorraad) || empty($artminvoorraad) || empty($artmaxvoorraad) || empty($artlocatie) || empty($levid)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        $sql = "UPDATE artikelen SET artikelenomschrijving = '$artikelenomschrijving', artinkoop = '$artinkoop', artverkoop = '$artverkoop', artvoorraad = '$artvoorraad', artminvoorraad = '$artminvoorraad', artmaxvoorraad = '$artmaxvoorraad', artlocatie = '$artlocatie', levid = '$levid' WHERE artid = $artid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Artikel succesvol bijgewerkt.";
        } else {
            echo "Fout bij het bijwerken van het artikel: " . $this->conn->error;
        }
    }

    public function deleteArtikel($artid) {
        $sql = "DELETE FROM artikelen WHERE artid = $artid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Artikel succesvol verwijderd.";
        } else {
            echo "Fout bij het verwijderen van het artikel: " . $this->conn->error;
        }
    }
}
class Leveranciers extends Config {
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Kan geen verbinding maken met de database: " . $this->conn->connect_error);
        }
    }

    public function selectAllLeveranciers() {
        $sql = "SELECT * FROM leveranciers";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Leverancier ID</th><th>Leverancier Naam</th><th>Contactpersoon</th><th>Email</th><th>Adres</th><th>Postcode</th><th>Woonplaats</th><th>Acties</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['levid'] . "</td>";
                echo "<td>" . $row['levnaam'] . "</td>";
                echo "<td>" . $row['levcontact'] . "</td>";
                echo "<td>" . $row['levemail'] . "</td>";
                echo "<td>" . $row['levadres'] . "</td>";
                echo "<td>" . $row['levpostcode'] . "</td>";
                echo "<td>" . $row['levwoonplaats'] . "</td>";
                echo "<td><a href='?action=update&id=" . $row['levid'] . "'>Bijwerken</a> | <a href='?action=delete&id=" . $row['levid'] . "' onclick='return confirm(\"Weet je zeker dat je deze leverancier wilt verwijderen?\")'>Verwijderen</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Geen leveranciers gevonden.";
        }
    }

    public function updateLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats) {
        // Check for empty fields
        if (empty($levnaam) || empty($levcontact) || empty($levemail) || empty($levadres) || empty($levpostcode) || empty($levwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        $sql = "UPDATE leveranciers SET levnaam = '$levnaam', levcontact = '$levcontact', levemail = '$levemail', levadres = '$levadres', levpostcode = '$levpostcode', levwoonplaats = '$levwoonplaats' WHERE levid = $levid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Leverancier succesvol bijgewerkt.";
        } else {
            echo "Fout bij het bijwerken van de leverancier: " . $this->conn->error;
        }
    }

    public function deleteLeverancier($levid) {
        $sql = "DELETE FROM leveranciers WHERE levid = $levid";

        if ($this->conn->query($sql) === TRUE) {
            echo "Leverancier succesvol verwijderd.";
        } else {
            echo "Fout bij het verwijderen van de leverancier: " . $this->conn->error;
        }
    }
}

class Order {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getInkoopOrders() {
        try {
            $query = "SELECT * FROM inkooporders";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de inkooporders: " . $e->getMessage();
            return false;
        }
    }

    public function updateInkoopOrder($inkordid, $artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus) {
        try {
            $query = "UPDATE inkooporders SET
                        artid = :artid,
                        levid = :levid,
                        inkorddatum = :inkorddatum,
                        inkordbestaantal = :inkordbestaantal,
                        inkordstatus = :inkordstatus
                    WHERE inkordid = :inkordid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':artid', $artid);
            $stmt->bindParam(':levid', $levid);
            $stmt->bindParam(':inkorddatum', $inkorddatum);
            $stmt->bindParam(':inkordbestaantal', $inkordbestaantal);
            $stmt->bindParam(':inkordstatus', $inkordstatus);
            $stmt->bindParam(':inkordid', $inkordid);
            $stmt->execute();

            return true;
        } catch(PDOException $e) {
            echo "Fout bij het bijwerken van de inkooporder: " . $e->getMessage();
            return false;
        }
    }

    public function deleteInkoopOrder($inkordid) {
        try {
            $query = "DELETE FROM inkooporders WHERE inkordid = :inkordid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':inkordid', $inkordid);
            $stmt->execute();

            echo "Inkooporder is verwijderd.";
            return true;
        } catch(PDOException $e) {
            echo "Fout bij het verwijderen van de inkooporder: " . $e->getMessage();
            return false;
        }
    }

    public function getVerkoopOrders() {
        try {
            $query = "SELECT * FROM verkooporders";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de verkooporders: " . $e->getMessage();
            return false;
        }
    }

    public function updateVerkoopOrder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus) {
        try {
            $query = "UPDATE verkooporders SET
                        artid = :artid,
                        klantid = :klantid,
                        verkorddatum = :verkorddatum,
                        verkordbestaantal = :verkordbestaantal,
                        verkordstatus = :verkordstatus
                    WHERE verkordid = :verkordid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':artid', $artid);
            $stmt->bindParam(':klantid', $klantid);
            $stmt->bindParam(':verkorddatum', $verkorddatum);
            $stmt->bindParam(':verkordbestaantal', $verkordbestaantal);
            $stmt->bindParam(':verkordstatus', $verkordstatus);
            $stmt->bindParam(':verkordid', $verkordid);
            $stmt->execute();

            return true;
        } catch(PDOException $e) {
            echo "Fout bij het bijwerken van de verkooporder: " . $e->getMessage();
            return false;
        }
    }

    public function deleteVerkoopOrder($verkordid) {
        try {
            $query = "DELETE FROM verkooporders WHERE verkordid = :verkordid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':verkordid', $verkordid);
            $stmt->execute();

            echo "Verkooporder is verwijderd.";
            return true;
        } catch(PDOException $e) {
            echo "Fout bij het verwijderen van de verkooporder: " . $e->getMessage();
            return false;
        }
    }
}
?>