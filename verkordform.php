<!DOCTYPE html>
<html>
<head>
    <title>Verkooporder Formulier</title>
    <link rel="stylesheet" type="text/css" href="cssbas.css" />
</head>
<body>
    <h1>Verkooporder</h1>
    <h2>Toevoegen</h2>
    <form method="POST" action="inserverkord.php">
        <label for="verkordid">Verkooporder ID:</label>
        <input type="text" name="verkordid" id="verkordid" required>
        <br>

        <label for="artid">Artikel ID:</label>
        <input type="text" name="artid" id="artid" required>
        <br>
        <label for="klantid">Klant ID:</label>
        <input type="text" name="klantid" id="klantid" required>
        <br>
        <label for="verkorddatum">Verkooporder Datum:</label>
        <input type="date" name="verkorddatum" id="verkorddatum" required>
        <br>
        <label for="verkordbestaantal">Verkooporder Aantal:</label>
        <input type="number" name="verkordbestaantal" id="verkordbestaantal" required>
        <br>
        <label for="verkordstatus">Verkooporder Status:</label>
        <input type="text" name="verkordstatus" id="verkordstatus" required>

        <input type="submit" name="insert" value="Toevoegen">
    </form>
</body>
</html>