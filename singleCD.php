<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tracks</title>
</head>

<?php
include('background.php');

$target = $_GET["target"];



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


$sql3 = "SELECT cdTitle FROM cd WHERE cdID = '$target'";
$result3 = $conn->query($sql3);

$titleTemp = $result3->fetch_assoc();

?>

<h1>All songs from <?php echo $titleTemp["cdTitle"]?></h1>

<br><br>

<?php


$sql = "SELECT trackID,cdID,trackTitle,trackRuntime FROM tracks WHERE cdID = '$target'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>trackID</th><th>CD title</th>
            <th>trackTitle</th><th>trackRuntime</th><th>Remove</th><th>Edit entry</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $temp = 'deleteTrack.php?delete='.$row["trackID"];
        $editTemp = 'editTrack.php?edit='.$row["trackID"];
        $currentCD = $row["cdID"];
        $sql2 = "SELECT cdTitle from cd WHERE cdID = '$currentCD'";
        $result2 = $conn->query($sql2);
        $currentCD = $result2->fetch_assoc();
        echo "<tr><td>".$row["trackID"]."</td><td>".$currentCD["cdTitle"].
            "</td><td>".$row["trackTitle"]."</td><td>".$row["trackRuntime"]
            ."</td><td>"."<a href='$temp'>Delete Entry</a></td>
            <td><a href='$editTemp'>Edit Entry</a></td>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>


<body>

<br><br>

<form action="addTrack.php">

    <h1>Add a track to the database-</h1> <br><br>
    <p>
        Track title:
        <input type="text" name="track" required minlength="1"/>
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
        <input type="number" min =0 step = 1 name="runtime" required minlength="1"/>
    </p>

    <p>
        <input type="submit" value="Confirm" />
    </p>
</form>

</body>
</html>