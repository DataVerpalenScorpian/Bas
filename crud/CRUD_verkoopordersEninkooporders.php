<?php
include 'conn.php';
include 'Config.php';
include 'classes/order.php';

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
                    echo "Inkooporder is verwijderd.";
                }
            } else {
                $updated = $order->updateInkoopOrder($inkordid, $artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus);
                if ($updated) {
                    echo "Inkooporder is bijgewerkt.";
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
                    echo "Verkooporder is verwijderd.";
                }
            } else {
                $updated = $order->updateVerkoopOrder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus);
                if ($updated) {
                    echo "Verkooporder is bijgewerkt.";
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
