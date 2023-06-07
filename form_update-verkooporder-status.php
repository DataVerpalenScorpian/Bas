<?php
include 'update_verkooporder-status.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verkooporders</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
</head>
<body>
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
                    <input type="hidden" name="verkordid" value="<?php echo $order['verkordid']; ?>">
                    <input type="text" name="artid" value="<?php echo $order['artid']; ?>">
                    <input type="text" name="klantid" value="<?php echo $order['klantid']; ?>">
                    <input type="date" name="verkorddatum" value="<?php echo $order['verkorddatum']; ?>">
                    <input type="number" name="verkordbestaantal" value="<?php echo $order['verkordbestaantal']; ?>">
                    <input type="text" name="verkordstatus" value="<?php echo $order['verkordstatus']; ?>">
                    <input type="submit" value="Bijwerken">
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
