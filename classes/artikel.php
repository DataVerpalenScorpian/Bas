<?php
class Artikelen extends Config {
    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function selectAllArtikelen() {
        try {
            $sql = "SELECT * FROM artikelen";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                echo "<table>";
                echo "<tr><th>Artikel ID</th><th>Artikel Omschrijving</th><th>Artikel Inkoop</th><th>Artikel Verkoop</th><th>Artikel Voorraad</th><th>Artikel Minimale Voorraad</th><th>Artikel Maximale Voorraad</th><th>Artikel Locatie</th><th>Leverancier ID</th><th>Acties</th></tr>";

                foreach ($result as $row) {
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
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de artikelen: " . $e->getMessage();
        }
    }

    public function updateArtikel($artid, $artikelenomschrijving, $artinkoop, $artverkoop, $artvoorraad, $artminvoorraad, $artmaxvoorraad, $artlocatie, $levid) {
        // Check for empty fields
        if (empty($artikelenomschrijving) || empty($artinkoop) || empty($artverkoop) || empty($artvoorraad) || empty($artminvoorraad) || empty($artmaxvoorraad) || empty($artlocatie) || empty($levid)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        try {
            $sql = "UPDATE artikelen SET artikelenomschrijving = :artikelenomschrijving, artinkoop = :artinkoop, artverkoop = :artverkoop, artvoorraad = :artvoorraad, artminvoorraad = :artminvoorraad, artmaxvoorraad = :artmaxvoorraad, artlocatie = :artlocatie, levid = :levid WHERE artid = :artid";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':artikelenomschrijving', $artikelenomschrijving);
            $stmt->bindParam(':artinkoop', $artinkoop);
            $stmt->bindParam(':artverkoop', $artverkoop);
            $stmt->bindParam(':artvoorraad', $artvoorraad);
            $stmt->bindParam(':artminvoorraad', $artminvoorraad);
            $stmt->bindParam(':artmaxvoorraad', $artmaxvoorraad);
            $stmt->bindParam(':artlocatie', $artlocatie);
            $stmt->bindParam(':levid', $levid);
            $stmt->bindParam(':artid', $artid);
            $stmt->execute();

            echo "Artikel succesvol bijgewerkt.";
        } catch(PDOException $e) {
            echo "Fout bij het bijwerken van het artikel: " . $e->getMessage();
        }
    }

    public function deleteArtikel($artid) {
        try {
            $sql = "DELETE FROM artikelen WHERE artid = :artid";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':artid', $artid);
            $stmt->execute();

            echo "Artikel succesvol verwijderd.";
        } catch(PDOException $e) {
            echo "Fout bij het verwijderen van het artikel: " . $e->getMessage();
        }
    }

    public function getArtikelById($artid) {
        $query = "SELECT * FROM artikelen WHERE artid = :artid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':artid', $artid);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } else {
            return false;
        }
    }


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
}
?>
