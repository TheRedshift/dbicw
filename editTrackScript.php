<?php
/**
 * Created by PhpStorm.
 * User: Rahul Soni
 * Date: 28/04/2016
 * Time: 22:00
 */



include 'db.php';

$temp = $_GET['artist'];
$tempID = $_GET['artID'];


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

$sql = "update artist set artName = '$temp' where artID = '$tempID'";

$result = $conn->query($sql);

if (!$result)
{
    header('Location: TrackPage.php?success=-3');
}
else
{
    header('Location: TrackPage.php?success=3');
}

$conn->close();



