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
include 'db.php';
$target = $_GET["search"];

$sql3 = "SELECT * FROM artist WHERE artName = '$target'";
$result3 = $conn->query($sql3);

$titleTemp = $result3->fetch_assoc();

?>

<h1>All entries matching <?php echo $target?></h1>

<br><br>

<?php

$sql4 = "SELECT artID,artName FROM artist WHERE artName LIKE ?";


$param = '%'.$target.'%';

if ($stmt = $conn->prepare($sql4))
{
    $stmt->bind_param('s', $param);
    $stmt->execute();
    $result = $stmt->   get_result();

}


if ($result->num_rows > 0) {
    echo "<table><tr><th>artID</th><th>artName</th><th>Albums</th>
                <th>Remove</th><th>Edit entry</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc())
    {
        $temp = 'deleteArtist.php?delete='.$row["artID"];
        $editTemp = 'editArtist.php?edit='.$row["artID"];
        $view = 'singleArtist.php?target='.$row["artID"];

        echo "<tr><td>".$row["artID"]."</td>
                <td>".$row["artName"]."</td>
                <td>"."<a href='$view'>View albums</a></td>
                <td>"."<a href='$temp'>Delete Entry</a></td>
                <td>"."<a href='$editTemp'>Edit Entry</a></td>";
    }
    echo "</table>";



} else {
    echo "0 results";
}
$conn->close();
?>

<br><br>



</body>
</html>

