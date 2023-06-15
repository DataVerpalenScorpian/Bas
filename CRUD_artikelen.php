<?php
include 'conn.php';
include 'Config.php';
include 'classes.php';

// Create an instance of the Artikelen class
$artikelen = new Artikelen();

// Process the updated article data if submitted
if (isset($_POST['update'])) {
    $artid = $_POST['artid'];
    $artikelenomschrijving = $_POST['artikelenomschrijving'];
    $artinkoop = $_POST['artinkoop'];
    $artverkoop = $_POST['artverkoop'];
    $artvoorraad = $_POST['artvoorraad'];
    $artminvoorraad = $_POST['artminvoorraad'];
    $artmaxvoorraad = $_POST['artmaxvoorraad'];
    $artlocatie = $_POST['artlocatie'];
    $levid = $_POST['levid'];

    $artikelen->updateArtikel($artid, $artikelenomschrijving, $artinkoop, $artverkoop, $artvoorraad, $artminvoorraad, $artmaxvoorraad, $artlocatie, $levid);
}

// Process the deletion of an article if requested
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $artid = $_GET['id'];
    $artikelen->deleteArtikel($artid);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Artikelenbeheer</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
    <style>
            table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Artikelenbeheer</h2>

    <h3>Artikelenoverzicht</h3>
    <?php $artikelen->selectAllArtikelen(); ?>

    <h3>Artikel bijwerken</h3>
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
        $artid = $_GET['id'];
        $sql = "SELECT * FROM artikelen WHERE artid = $artid";
        $result = $artikelen->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="">
                <input type="hidden" name="artid" value="<?php echo $row['artid']; ?>">
                <label>Artikel Omschrijving:</label>
                <input type="text" name="artikelenomschrijving" value="<?php echo $row['artikelenomschrijving']; ?>" required><br><br>
                <label>Artikel Inkoop:</label>
                <input type="text" name="artinkoop" value="<?php echo $row['artinkoop']; ?>" required><br><br>
                <label>Artikel Verkoop:</label>
                <input type="text" name="artverkoop" value="<?php echo $row['artverkoop']; ?>" required><br><br>
                <label>Artikel Voorraad:</label>
                <input type="text" name="artvoorraad" value="<?php echo $row['artvoorraad']; ?>" required><br><br>
                <label>Artikel Minimale Voorraad:</label>
                <input type="text" name="artminvoorraad" value="<?php echo $row['artminvoorraad']; ?>" required><br><br>
                <label>Artikel Maximale Voorraad:</label>
                <input type="text" name="artmaxvoorraad" value="<?php echo $row['artmaxvoorraad']; ?>" required><br><br>
                <label>Artikel Locatie:</label>
                <input type="text" name="artlocatie" value="<?php echo $row['artlocatie']; ?>" required><br><br>
                <label>Lev ID:</label>
                <input type="text" name="levid" value="<?php echo $row['levid']; ?>" required><br><br>
                <input type="submit" name="update" value="Artikel bijwerken">
            </form>
            <?php
        } else {
            echo "Geen artikel gevonden.";
        }
    }
    ?>

    <br>
    <a href="form_insert_artikelen.php" class="button">Artikelen Toevoegen</a>
    <br><br>
    <a href="Index.php" class="button">Terug naar Homepage</a>
</body>
</html>

