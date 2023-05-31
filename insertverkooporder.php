<!DOCTYPE html>
<html>
<head>
    <title>Verkooporder toevoegen</title>
</head>
<body>
    <h2>Verkooporder toevoegen</h2>
    <form method="POST" action="insertverkoop.php">
        <label for="artid">Artikel ID:</label>
        <input type="text" name="artid" id="artid" required><br>

        <label for="klantid">Klant ID:</label>
        <input type="text" name="klantid" id="klantid" required><br>

        <label for="verkorddatum">Verkoopdatum:</label>
        <input type="date" name="verkorddatum" id="verkorddatum" required><br>

        <label for="verkordbestaantal">Besteld aantal:</label>
        <input type="number" name="verkordbestaantal" id="verkordbestaantal" required><br>

        <label for="verkordstatus">Status:</label>
        <input type="text" name="verkordstatus" id="verkordstatus" required><br>

        <input type="submit" name="insert" value="Verkooporder toevoegen">
    </form>
    </br>
	<a href='index.php'>Terug naar homepage</a>
</body>
</html>
