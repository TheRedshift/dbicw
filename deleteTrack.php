<?php
/**
 * Created by PhpStorm.
 * User: Rahul Soni
 * Date: 28/04/2016
 * Time: 22:00
 */



include 'db.php';

$temp = $_GET['delete'];


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

$sql = "delete from tracks where trackID = $temp";
$result = $conn->query($sql);

if (!$result)
{
    header('Location: TrackPage.php?success=-2');
}
else
{
    header('Location: TrackPage.php?success=2');
}

$conn->close();

