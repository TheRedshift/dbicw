<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>The Compendium</title>
</head>

<?php
include('background.php');
include 'db.php';
?>

<body>

<br>

<h1>Welcome to the Compendium's database management system. </h1> <br>
<?php



// Create connection
$sql = "SELECT COUNT(artID) FROM artist;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_array(MYSQLI_NUM))
{
    foreach ($row as $r)
    {
        $artIDCount = $r;
    }
    print "\n";
}
if (!$result) echo "failed to search record - are you sure the artist is in the system?";

// Create connection
$sql = "SELECT COUNT(cdID) FROM CD;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_array(MYSQLI_NUM))
{
    foreach ($row as $r)
    {
        $cdIDCount = $r;
    }
    print "\n";
}
if (!$result) echo "failed to search record - are you sure the artist is in the system?";


// Create connection
$sql = "SELECT COUNT(trackID) FROM tracks;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_array(MYSQLI_NUM))
{
    foreach ($row as $r)
    {
        $trackIDCount = $r;
    }
    print "\n";
}
if (!$result) echo "failed to search record - are you sure the artist is in the system?";




?>

<table width="300">
    <tr>
        <th>Table</th>
        <th>Total entries</th>

    </tr>
    <tr>
        <th>Artists</th>
        <td><?php echo $artIDCount ?></td>

    </tr>
    <tr>
        <th>CDs</th>
        <td><?php echo $cdIDCount ?></td>

    </tr>
    <tr>
        <th>Tracks</th>
        <td><?php echo $trackIDCount ?></td>

    </tr>
</table>

</body>
</html>