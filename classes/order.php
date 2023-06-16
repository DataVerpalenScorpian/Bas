<?php
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