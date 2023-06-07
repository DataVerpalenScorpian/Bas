<?php
include_once 'inkooporder.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Inkooporder formulier</title>
</head>
<body>
    <h1>Inkooporder formulier</h1>
    <form method="POST" action="">
        <label for="artid">Artikel:</label>
        <?php echo $inkooporder->getArtikelDropdown(); ?><br><br>

        <label for="levid">Leverancier:</label>
        <?php echo $inkooporder->getLeverancierDropdown(); ?><br><br>

        <label for="inkorddatum">Inkooporder datum:</label>
        <input type="date" name="inkorddatum" id="inkorddatum"><br><br>

        <label for="inkordbestaantal">Inkooporder bestelhoeveelheid:</label>
        <input type="text" name="inkordbestaantal" id="inkordbestaantal"><br><br>

        <label for="inkordstatus">Inkooporder status:</label>
        <input type="text" name="inkordstatus" id="inkordstatus"><br><br>

        <input type="submit" name="insert" value="Inkooporder toevoegen">
    </form>
</body>
</html>