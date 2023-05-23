<!DOCTYPE html>
<html>
<body>

	<h1>Klant</h1>
	<h2>Toevoegen</h2>
	<form method="post" action="insertklant.php">
        <br>   
    <label for="an">Klantnaam:</label>
    <input type="text" id="" name="klantnaam" placeholder="klantnaam" required/>
        <br>
    <label for="an">Klantemail:</label>
    <input type="text" id="" name="klantemail" placeholder="klantemail" required/>
        <br>
    <label for="an">Klantadres:</label>
    <input type="text" id="" name="klantadres" placeholder="klantadres" required/>
        <br>
    <label for="an">Klantpostcode:</label>
    <input type="text" id="rt" name="klantpostcode" placeholder="klantpostcode" required/>
        <br>
    <label for="an">Klantwoonplaats:</label>
    <input type="text" id="" name="klantwoonplaats" placeholder="klantwoonplaats" required/>
        <br><br>
    <input type='submit' name='insert' value='Toevoegen'>
    </form></br>

	<a href='index.php'>Terug</a>

</body>
</html>



