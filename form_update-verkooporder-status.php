<?php
include 'CRUD_verkoopordersEninkooporders.php';

try {
    // ...

    // Order bijwerken
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Inkooporder bijwerken
        if (isset($_POST['inkooporder'])) {
            // ...

            if (isset($_POST['delete'])) {
                // ...
            } else {
                // ...

                // Inkooporder bijwerken
                $updated = $order->updateInkoopOrder($inkordid, $artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus);
                if ($updated) {
                    // ...
                }
            }
        }

        // Verkooporder bijwerken
        if (isset($_POST['verkooporder'])) {
            // ...

            if (isset($_POST['delete'])) {
                $deleted = $order->deleteVerkoopOrder($verkordid);
                if ($deleted) {
                    // Display success message or perform any other desired actions
                } else {
                    // Display error message or perform any other desired actions
                }
            } else {
                // Verkooporder bijwerken
                $updated = $order->updateVerkoopOrder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus);
                if ($updated) {
                    // ...
                }
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
                    <select name="inkordstatus">
                        <option value="1" <?php if ($order['inkordstatus'] == '1') { echo 'selected'; } ?>>Ja</option>
                        <option value="2" <?php if ($order['inkordstatus'] == '2') { echo 'selected'; } ?>>Nee</option>
                    </select>
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
        <th>Actie</th>
    </tr>
    <?php foreach ($verkoopOrders as $order) { ?>
        <tr>
            <td><?php echo $order['verkordid']; ?></td>
            <td><?php echo $order['artid']; ?></td>
            <td><?php echo $order['klantid']; ?></td>
            <td><?php echo $order['verkorddatum']; ?></td>
            <td><?php echo $order['verkordbestaantal']; ?></td>
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="verkooporder" value="1">
                    <input type="hidden" name="verkordid" value="<?php echo $order['verkordid']; ?>">
                    <input type="text" name="artid" value="<?php echo $order['artid']; ?>">
                    <input type="text" name="klantid" value="<?php echo $order['klantid']; ?>">
                    <input type="date" name="verkorddatum" value="<?php echo $order['verkorddatum']; ?>">
                    <input type="number" name="verkordbestaantal" value="<?php echo $order['verkordbestaantal']; ?>">
                    <select name="verkordstatus">
                        <option value="1" <?php if ($order['verkordstatus'] == '1') { echo 'selected'; } ?>>Genoteerd in deze tabel</option>
                        <option value="2" <?php if ($order['verkordstatus'] == '2') { echo 'selected'; } ?>>Magazijnmedewerker verzamelt het artikel (picking)</option>
                        <option value="3" <?php if ($order['verkordstatus'] == '3') { echo 'selected'; } ?>>Tas met artikel is bij de bezorger</option>
                        <option value="4" <?php if ($order['verkordstatus'] == '4') { echo 'selected'; } ?>>Tas met artikel is afgeleverd bij de klant</option>
                    </select>
                    <input type="submit" value="Bijwerken">
                    <input type="submit" name="delete" value="Verwijderen">
                </form>
            </td>
        </tr>
    <?php } ?>
    </table>
</body>
</html>
