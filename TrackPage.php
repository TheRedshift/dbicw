<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tracks</title>
</head>

<?php
include('background.php');

if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
    // treat the success case ex:
    $message = "Track Successfully added!";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == -1 )
{
    $message = "Something appears to have gone wrong - please try again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}

?>


<?php
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

$sql = "SELECT trackID,cdID,trackTitle,trackRuntime FROM tracks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>trackID</th><th>cdID</th>
            <th>trackTitle</th><th>trackRuntime</th>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["trackID"]."</td><td>".$row["cdID"].
            "</td><td>".$row["trackTitle"]."</td><td>".$row["trackRuntime"];
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>


<body>

<br>

<form action="addTrack.php">

    <h1>Add a track to the database.</h1> <br><br>
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
        <input type="submit" value="Insert" />
    </p>
</form>

</body>
</html>