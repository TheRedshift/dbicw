<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Artist</title>
</head>


<body>

<?php
include('background.php');
include 'db.php';

$temp = $_GET['edit'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DBICW";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select cdTitle,cdPrice,cdTracks from cd where cdID = $temp";
$result = $conn->query($sql);

if (!$result)
{
    header('Location: ArtistPage.php?success=-3');
}
else{
    while ($cdEdit = mysqli_fetch_array($result))
    {
        $cdTitle = $cdEdit["cdTitle"];
        $cdPrice = $cdEdit["cdPrice"];
        $cdTracks = $cdEdit["cdTracks"];

    }


}


?>



<form action="editCDScript.php">

    <h1>Edit a CD already in the database.</h1> <br><br>
    <p>
        CD title:
        <input type="text" name="cd" value = "<?php echo $cdTitle?>" required minlength="1"/>
    </p>

    <p>

        <!-- Modified from stackoverflow code - 23546818 -->
        <?php
        include 'db.php';
        $stmt = $conn->prepare("SELECT artName FROM artist");
        $stmt->execute();
        $array = [];


        foreach ($stmt->get_result() as $row)
        {
            $array[] = $row['artName'];
        }
        ?>
        Artist:
        <select name="artist" id="artist" required>
            <option selected="selected">Choose one</option>

            <?php

            foreach($array as $key =>$value)
            {?>

                <option value="<?=$value?>"><?=$value?></option>
                <?php
            } ?>
        </select>

    </p>

    <p>
        CD Price (pennies):
        <input type="number" min = 0 step = 1 name = "price" value = "<?php echo $cdPrice?>" required/>
    </p>

    <p>
        Genre:
        <select name="genre">
            <option value="Rock">Rock</option>
            <option value="Pop">Pop</option>
            <option value="Classical">Classical</option>
            <option value="Rap">Rap</option>
        </select>
    </p>

    <p>
        Number of tracks:
        <input type="number" min = 1 step = 1 name = "tracks" value = "<?php echo $cdTracks?>" required/>
    </p>

        <input type="hidden"  name="cdID" value="<?php echo $temp?>"  required />

    <p>
        <input type="submit" value="Insert" />
    </p>
</form>



</body>
</html>