<?php
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
?>