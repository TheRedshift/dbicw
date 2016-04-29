<?php
/**
 * Created by PhpStorm.
 * User: Rahul Soni
 * Date: 28/04/2016
 * Time: 22:00
 */



include 'db.php';

$trackTitle = $_GET["track"];
$trackRuntime = $_GET["runtime"];
$trackID = $_GET["trackID"];
$cdName = $_GET["cd"];


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


$sql1 = "SELECT cdID FROM cd WHERE cdTitle ='$cdName' ";





$result1 = $conn->query($sql1);

while ($row = $result1->fetch_array(MYSQLI_NUM))
{
    foreach ($row as $r)
    {
        $cdID = $r;
    }
    print "\n";
}

if (!$result1) echo "failed to search record - are you sure the artist is in the system?";

$sql = "update tracks set cdID = '$cdID', trackTitle = '$trackTitle', trackRuntime = '$trackRuntime'
        where trackID = '$trackID'";

$result = $conn->query($sql);



if (!$result)
{
    header('Location: trackPage.php?success=-3');
}
else
{
    header('Location: trackPage.php?success=3');
}

$conn->close();



