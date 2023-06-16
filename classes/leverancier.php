<?php
class Leveranciers extends Config {
    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function selectAllLeveranciers() {
        try {
            $query = "SELECT * FROM leveranciers";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                echo "<table>";
                echo "<tr><th>Leverancier ID</th><th>Leverancier Naam</th><th>Contactpersoon</th><th>Email</th><th>Adres</th><th>Postcode</th><th>Woonplaats</th><th>Acties</th></tr>";

                foreach ($result as $row) {
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
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de leveranciers: " . $e->getMessage();
        }
    }

    public function updateLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats) {
        // Check for empty fields
        if (empty($levnaam) || empty($levcontact) || empty($levemail) || empty($levadres) || empty($levpostcode) || empty($levwoonplaats)) {
            echo "Fout: Alle velden moeten worden ingevuld.";
            return;
        }

        try {
            $query = "UPDATE leveranciers SET levnaam = :levnaam, levcontact = :levcontact, levemail = :levemail, levadres = :levadres, levpostcode = :levpostcode, levwoonplaats = :levwoonplaats WHERE levid = :levid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':levnaam', $levnaam);
            $stmt->bindParam(':levcontact', $levcontact);
            $stmt->bindParam(':levemail', $levemail);
            $stmt->bindParam(':levadres', $levadres);
            $stmt->bindParam(':levpostcode', $levpostcode);
            $stmt->bindParam(':levwoonplaats', $levwoonplaats);
            $stmt->bindParam(':levid', $levid);
            $stmt->execute();

            echo "Leverancier succesvol bijgewerkt.";
        } catch(PDOException $e) {
            echo "Fout bij het bijwerken van de leverancier: " . $e->getMessage();
        }
    }

    public function deleteLeverancier($levid) {
        try {
            $query = "DELETE FROM leveranciers WHERE levid = :levid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':levid', $levid);
            $stmt->execute();

            echo "Leverancier succesvol verwijderd.";
        } catch(PDOException $e) {
            echo "Fout bij het verwijderen van de leverancier: " . $e->getMessage();
        }
    }
}
?>
