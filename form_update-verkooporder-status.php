<?php
include 'update_verkooporder-status.php';

try {
    // ...

    // Order bijwerken
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Inkooporder bijwerken
if (isset($_POST['inkooporder'])) {
    // ...

    if (isset($_POST['delete'])) {
        $deleted = $order->deleteInkoopOrder($inkordid);
        if ($deleted) {
            // Toon een succesbericht of voer andere acties uit

            // Vernieuw de pagina
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    } else {
        // ...

        // Inkooporder bijwerken
        $updated = $order->updateInkoopOrder($inkordid, $artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus);
        if ($updated) {
            // Toon een succesbericht of voer andere acties uit

            // Vernieuw de pagina
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    }
}

        // Verkooporder bijwerken
        if (isset($_POST['verkooporder'])) {
            // ...

            if (isset($_POST['delete'])) {
                $deleted = $order->deleteVerkoopOrder($verkordid);
                if ($deleted) {
                    // Toon een succesbericht of voer andere acties uit

                    // Vernieuw de pagina
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                }
            } else {
                // ...
            }
        }
    }
} catch(Exception $e) {
    // ...
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
</head>
<body>
    <h1>Inkooporders</h1>

    <table>
    <tr>
        <th>Order ID</th>
        <th>Artikel ID</th>
        <th>Leverancier ID</th>
        <th>Datum</th>
        <th>Aantal</th>
        <th>Status</th>
        <th>Actie</th>
    </tr>
    <?php foreach ($inkoopOrders as $order) { ?>
        <tr>
            <td><?php echo $order['inkordid']; ?></td>
            <td><?php echo $order['artid']; ?></td>
            <td><?php echo $order['levid']; ?></td>
            <td><?php echo $order['inkorddatum']; ?></td>
            <td><?php echo $order['inkordbestaantal']; ?></td>
            <td><?php echo $order['inkordstatus']; ?></td>
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="inkooporder" value="1">
                    <input type="hidden" name="inkordid" value="<?php echo $order['inkordid']; ?>">
                    <input type="text" name="artid" value="<?php echo $order['artid']; ?>">
                    <input type="text" name="levid" value="<?php echo $order['levid']; ?>">
                    <input type="date" name="inkorddatum" value="<?php echo $order['inkorddatum']; ?>">
                    <input type="number" name="inkordbestaantal" value="<?php echo $order['inkordbestaantal']; ?>">
                    <input type="text" name="inkordstatus" value="<?php echo $order['inkordstatus']; ?>">
                    <input type="submit" value="Bijwerken">
                    <input type="submit" name="delete" value="Verwijderen">
                </form>
            </td>
        </tr>
    <?php } ?>
    </table>

    <h1>Verkooporders</h1>

    <table>
    <tr>
        <th>Order ID</th>
        <th>Artikel ID</th>
        <th>Klant ID</th>
        <th>Datum</th>
        <th>Aantal</th>
        <th>Status</th>
        <th>Actie</th>
    </tr>
    <?php foreach ($verkoopOrders as $order) { ?>
        <tr>
            <td><?php echo $order['verkordid']; ?></td>
            <td><?php echo $order['artid']; ?></td>
            <td><?php echo $order['klantid']; ?></td>
            <td><?php echo $order['verkorddatum']; ?></td>
            <td><?php echo $order['verkordbestaantal']; ?></td>
            <td><?php echo $order['verkordstatus']; ?></td>
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="verkooporder" value="1">
                    <input type="hidden" name="verkordid" value="<?php echo $order['verkordid']; ?>">
                    <input type="text" name="artid" value="<?php echo $order['artid']; ?>">
                    <input type="text" name="klantid" value="<?php echo $order['klantid']; ?>">
                    <input type="date" name="verkorddatum" value="<?php echo $order['verkorddatum']; ?>">
                    <input type="number" name="verkordbestaantal" value="<?php echo $order['verkordbestaantal']; ?>">
                    <input type="text" name="verkordstatus" value="<?php echo $order['verkordstatus']; ?>">
                    <input type="submit" value="Bijwerken">
                    <input type="submit" name="delete" value="Verwijderen">
                </form>
            </td>
        </tr>
    <?php } ?>
    </table>
</body>
</html>
