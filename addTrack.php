<?php
/**
 * Created by PhpStorm.
 * User: Rahul Soni
 * Date: 28/04/2016
 * Time: 10:57
 */

include 'db.php'; // include our database connection

$trackTitle = $_GET['track'];
$cdTitle = $_GET['cd'];

$sql1 = "SELECT cdID FROM cd WHERE cdTitle ='$cdTitle' ";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();

while ($row = $result1->fetch_array(MYSQLI_NUM))
{
    foreach ($row as $r)
    {
        $cdID = $r;
    }
    print "\n";
}

if (!$result1) echo "failed to search record - CD may not exist!";



$trackRuntime = $_GET['runtime'];


$sql = "INSERT INTO tracks (trackTitle, cdID, trackRuntime) VALUES (?,?,?)";


if ($stmt = $conn->prepare($sql))
{
    $stmt->bind_param('sii', $trackTitle, $cdID, $trackRuntime);

    $result = $stmt->execute();
    if (!$result) echo "failed to insert record - are you sure the CD is in the system?";
}
else
{
    echo htmlspecialchars($conn->error);
}

