<?php
include 'conn.php';
include 'Config.php';

    class Order {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
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

        public function updateOrder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus) {
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

                echo "Order is bijgewerkt.";
                return true;
            } catch(PDOException $e) {
                echo "Fout bij het bijwerken van de order: " . $e->getMessage();
                return false;
            }
        }
    }

    try {
        $order = new Order($conn);

        // Verkooporders ophalen
        $verkoopOrders = $order->getVerkoopOrders();

        // Order bijwerken
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $verkordid = isset($_POST['verkordid']) ? $_POST['verkordid'] : '';
            $artid = isset($_POST['artid']) ? $_POST['artid'] : '';
            $klantid = isset($_POST['klantid']) ? $_POST['klantid'] : '';
            $verkorddatum = isset($_POST['verkorddatum']) ? $_POST['verkorddatum'] : '';
            $verkordbestaantal = isset($_POST['verkordbestaantal']) ? $_POST['verkordbestaantal'] : '';
            $verkordstatus = isset($_POST['verkordstatus']) ? $_POST['verkordstatus'] : '';

            $updated = $order->updateOrder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus);
            if ($updated) {
                // Toon een succesbericht of voer andere acties uit
            }
        }
    } catch(Exception $e) {
        echo "Er is een fout opgetreden: " . $e->getMessage();
    }
?>

