<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CDs</title>
</head>

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

include('background.php');
$target = $_GET["target"];

$sql3 = "SELECT artName FROM artist WHERE artID = '$target'";
$result3 = $conn->query($sql3);

$titleTemp = $result3->fetch_assoc();

?>

<h1>All albums by <?php echo $titleTemp["artName"]?></h1>

<br><br>

<?php

$sql = "SELECT cdID,artID,cdTitle,cdPrice,cdGenre,cdTracks FROM cd WHERE artID = '$target'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>cdID</th><th>Artist</th>
            <th>cdTitle</th><th>cdPrice</th>
            <th>cdGenre</th><th>cdTracks</th><th>Tracks</th>
            <th>Remove</th><th>Edit entry</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $temp = 'deleteCd.php?delete='.$row["cdID"];
        $editTemp = 'editCD.php?edit='.$row["cdID"];
        $view = 'singleCD.php?target='.$row["cdID"];
        $currentArtist = $row["artID"];
        $sql2 = "SELECT artName from artist WHERE artID = '$currentArtist'";
        $result2 = $conn->query($sql2);
        $currentName = $result2->fetch_assoc();
        echo "<tr>
            <td>".$row["cdID"]."</td><td>".$currentName["artName"]."</td>
            <td>".$row["cdTitle"]."</td><td>"."£" . $row["cdPrice"] /100 ."</td>
            <td>".$row["cdGenre"]."</td><td>".$row["cdTracks"]."</td>
            <td>"."<a href='$view'>View tracks</a></td>
            <td>"."<a href='$temp'>Delete Entry</a></td>
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

    <h1>Add a CD to the database-</h1> <br><br>
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

