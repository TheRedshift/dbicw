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

$sql = "select trackTitle, trackRuntime from tracks where trackID = $temp";
$result = $conn->query($sql);

if (!$result)
{
    header('Location: ArtistPage.php?success=-3');
}
else{
    while ($trackEdit = mysqli_fetch_array($result))
    {
        $trackTitle = $trackEdit["trackTitle"];
        $trackRuntime = $trackEdit["trackRuntime"];

    }


}


?>



<form action="editTrackScript.php">

    <h1>Edit a track already in the database-</h1> <br><br>
    <p>
        Track title:
        <input type="text" name="track" value="<?php echo $trackTitle?>" required minlength="1"/>
    </p>

    <p>

        <!-- Modified from stackoverflow code - 23546818 -->
        <?php
        include 'db.php';
        $stmt = $conn->prepare("SELECT cdTitle FROM cd");
        $stmt->execute();
        $array = [];


        foreach ($stmt->get_result() as $row)
        {
            $array[] = $row['cdTitle'];
        }
        ?>
        CD:
        <select name="cd" id="cd">
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
        Track runtime(seconds) :
        <input type="number" min =0 step = 1 name="runtime" value="<?php echo $trackRuntime?>" required minlength="1"/>
    </p>
        <input type="hidden"  name="trackID" value="<?php echo $temp?>"  required />
    <p>
        <input type="submit" value="Confirm" />
    </p>
</form>



</body>
</html>