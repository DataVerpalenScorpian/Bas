<?php
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
?>