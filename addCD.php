<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Created by PhpStorm.
 * User: Rahul Soni
 * Date: 28/04/2016
 * Time: 10:57
 */

include 'db.php'; // include our database connection
$cdTitle = $_GET['cd'];

$artName = $_GET['artist'];
$sql1 = "SELECT artID FROM artist WHERE artName ='$artName' ";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
while ($row = $result1->fetch_array(MYSQLI_NUM))
{
    foreach ($row as $r)
    {
        $artID = $r;
    }
    print "\n";
}
if (!$result1) echo "failed to search record - are you sure the artist is in the system?";








$cdPrice = $_GET['price'];

$cdGenre = $_GET['genre'];

$cdTracks = $_GET['tracks'];



$sql = "INSERT INTO cd (artID, cdTitle, cdPrice, cdGenre, cdTracks) VALUES (?,?,?,?,?)";
if ($stmt = $conn->prepare($sql))
{
    $stmt->bind_param('isisi', $artID, $cdTitle, $cdPrice, $cdGenre, $cdTracks);

    $result = $stmt->execute();
    if (!$result) echo "failed to insert record - are you sure the artist is in the system?";
}
else
{
    echo htmlspecialchars($conn->error);
}


