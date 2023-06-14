<?php
include 'conn.php';
include 'Config.php';

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

            echo "Inkooporder is bijgewerkt.";
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

            echo "Verkooporder is bijgewerkt.";
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

try {
    $order = new Order($conn);

    // Inkooporders ophalen
    $inkoopOrders = $order->getInkoopOrders();

    // Order bijwerken of verwijderen
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['inkooporder'])) {
            $inkordid = isset($_POST['inkordid']) ? $_POST['inkordid'] : '';
            $artid = isset($_POST['artid']) ? $_POST['artid'] : '';
            $levid = isset($_POST['levid']) ? $_POST['levid'] : '';
            $inkorddatum = isset($_POST['inkorddatum']) ? $_POST['inkorddatum'] : '';
            $inkordbestaantal = isset($_POST['inkordbestaantal']) ? $_POST['inkordbestaantal'] : '';
            $inkordstatus = isset($_POST['inkordstatus']) ? $_POST['inkordstatus'] : '';

            if (isset($_POST['delete'])) {
                $deleted = $order->deleteInkoopOrder($inkordid);
                if ($deleted) {
                    // Toon een succesbericht of voer andere acties uit
                }
            } else {
                $updated = $order->updateInkoopOrder($inkordid, $artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus);
                if ($updated) {
                    // Toon een succesbericht of voer andere acties uit
                }
            }
        }

        if (isset($_POST['verkooporder'])) {
            $verkordid = isset($_POST['verkordid']) ? $_POST['verkordid'] : '';
            $artid = isset($_POST['artid']) ? $_POST['artid'] : '';
            $klantid = isset($_POST['klantid']) ? $_POST['klantid'] : '';
            $verkorddatum = isset($_POST['verkorddatum']) ? $_POST['verkorddatum'] : '';
            $verkordbestaantal = isset($_POST['verkordbestaantal']) ? $_POST['verkordbestaantal'] : '';
            $verkordstatus = isset($_POST['verkordstatus']) ? $_POST['verkordstatus'] : '';

            if (isset($_POST['delete'])) {
                $deleted = $order->deleteVerkoopOrder($verkordid);
                if ($deleted) {
                    // Toon een succesbericht of voer andere acties uit
                }
            } else {
                $updated = $order->updateVerkoopOrder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus);
                if ($updated) {
                    // Toon een succesbericht of voer andere acties uit
                }
            }
        }
    }

    // Verkooporders ophalen
    $verkoopOrders = $order->getVerkoopOrders();

} catch(Exception $e) {
    echo "Er is een fout opgetreden: " . $e->getMessage();
}
?>