<?php
/**
 * Created by PhpStorm.
 * User: Rahul Soni
 * Date: 28/04/2016
 * Time: 22:00
 */



include 'db.php';

$cdTitle = $_GET["cd"];
$cdPrice = $_GET["price"];
$cdTracks = $_GET["tracks"];
$artName = $_GET["artist"];
$cdGenre = $_GET["genre"];
$cdID = $_GET["cdID"];


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


$sql1 = "SELECT artID FROM artist WHERE artName ='$artName' ";





$result1 = $conn->query($sql1);

while ($row = $result1->fetch_array(MYSQLI_NUM))
{
    foreach ($row as $r)
    {
        $artID = $r;
    }
    print "\n";
}

if (!$result1) echo "failed to search record - are you sure the artist is in the system?";

$sql = "update cd set artID = '$artID', cdTitle = '$cdTitle', cdPrice = '$cdPrice', cdTracks = '$cdTracks'
        , cdGenre = '$cdGenre'where cdID = '$cdID'";

$result = $conn->query($sql);



if (!$result)
{
    header('Location: cdPage.php?success=-3');
}
else
{
    header('Location: cdPage.php?success=3');
}

$conn->close();



