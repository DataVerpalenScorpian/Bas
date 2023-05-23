<!DOCTYPE html>
<html>
<body>

	<h1>Verkooporder</h1>
	<h2>Toevoegen</h2>
	<form method="post" action="inserverkord.php">
        <br>   
    <label for="an">Verkooporderddatum:</label>
    <input type="text" id="" name="verkorddatum" placeholder="verkorddatum" required/>
        <br>
    <label for="an">Verkordbestelaantal:</label>
    <input type="text" id="" name="verkordbestaantal" placeholder="verkordbestaantal" required/>
        <br>
    <label for="an">Verkordstatus:</label>
    <input type="text" id="" name="verkordstatus" placeholder="verkordstatus" required/>
    <br><br>
    <input type='submit' name='insert' value='Toevoegen'>
    </form></br>

	<a href='index.php'>Terug</a>

</body>
</html>

