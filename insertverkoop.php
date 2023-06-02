<?php
include 'conn.php';
include 'Config.php';

class Verkooporder extends Config {

    public function getKlantDropdown() {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT klantid, klantnaam FROM klanten";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $klanten = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $dropdown = '<select name="klantid">';
            foreach ($klanten as $klant) {
                $klantid = $klant['klantid'];
                $klantnaam = $klant['klantnaam'];
                $dropdown .= "<option value=\"$klantid\">$klantnaam</option>";
            }
            $dropdown .= '</select>';

            return $dropdown;
        } catch (PDOException $e) {
            echo "Fout bij het ophalen van klanten: " . $e->getMessage();
            return '';
        }

        $conn = null;
    }

    public function getArtikelDropdown() {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT artid, artikelenomschrijving FROM artikelen";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $artikelen = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $dropdown = '<select name="artid">';
            foreach ($artikelen as $artikel) {
                $artid = $artikel['artid'];
                $artikelnaam = $artikel['artikelenomschrijving'];
                $dropdown .= "<option value=\"$artid\">$artikelnaam</option>";
            }
            $dropdown .= '</select>';

            return $dropdown;
        } catch (PDOException $e) {
            echo "Fout bij het ophalen van artikelen: " . $e->getMessage();
            return '';
        }

        $conn = null;
    }
}

// ... rest van de code ...

?>

<!DOCTYPE html>
<html>
<head>
    <title>Verkooporder toevoegen</title>
</head>
<body>
    <h1>Verkooporder toevoegen</h1>
    <form method="POST" action="">
        <label>Klant ID:</label>
        <?php
        $verkooporder = new Verkooporder();
        echo $verkooporder->getKlantDropdown();
        ?>
        <br>
        <label>Artikel ID:</label>
        <?php
        echo $verkooporder->getArtikelDropdown();
        ?>
        <br>
        <label>Verkooporderdatum:</label>
        <input type="text" name="verkorddatum" required>
        <br>
        <label>Aantal:</label>
        <input type="text" name="verkordbestaantal" required>
        <br>
        <label>Status:</label>
        <input type="text" name="verkordstatus" required>
        <br>
        <input type="submit" name="insert" value="Verkooporder toevoegen">
    </form>
</body>
</html>
