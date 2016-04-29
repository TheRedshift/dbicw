<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CDs</title>
</head>

<?php
include('background.php');

if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
    // treat the success case ex:
    $message = "CD Successfully added!";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == -1 )
{
    $message = "Something appears to have gone wrong - please try again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == -2 )
{
    $message = "Deleting entry failed - are you sure there are no tracks on the system with this cd?";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == 2 )
{
    $message = "Entry successfully deleted.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == -3 )
{
    $message = "Editing entry failed - please try again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == 3 )
{
    $message = "Entry successfully edited.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}

?>

<body>

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

$sql = "SELECT cdID,artID,cdTitle,cdPrice,cdGenre,cdTracks FROM cd";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>cdID</th><th>artID</th>
            <th>cdTitle</th><th>cdPrice</th>
            <th>cdGenre</th><th>cdTracks</th><th>Remove</th><th>Edit entry</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $temp = 'deleteCd.php?delete='.$row["cdID"];
        $editTemp = 'editCD.php?edit='.$row["cdID"];
        echo "<tr><td>".$row["cdID"]."</td><td>".$row["artID"].
            "</td><td>".$row["cdTitle"]."</td><td>"."£" . $row["cdPrice"] /100 .
            "</td><td>".$row["cdGenre"]."</td><td>".$row["cdTracks"]
            ."</td><td>"."<a href='$temp'>Delete Entry</a></td>
            <td><a href='$editTemp'>Edit Entry</a></td>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

<br><br>

<form action="addCD.php">

    <h1>Add a CD to the database.</h1> <br><br>
    <p>
        CD title:
        <input type="text" name="cd" required minlength="1"/>
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
        <input type="number" min = 0 step = 1 name = "price" required/>
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
        <input type="number" min = 1 step = 1 name = "tracks" required/>
    </p>

    <p>
        <input type="submit" value="Confirm" />
    </p>
</form>

</body>
</html>

