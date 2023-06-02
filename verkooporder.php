<?php
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
?>