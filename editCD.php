<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Artist</title>
</head>


<body>

<?php
include('background.php');
include 'db.php';

$temp = $_GET['edit'];


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

$sql = "select artName from artist where artID = $temp";
$result = $conn->query($sql);

if (!$result)
{
    header('Location: ArtistPage.php?success=-3');
}
else{
    while ($artName = mysqli_fetch_array($result))
    {
        $printName = $artName["artName"];
    }


}


?>



<form action="editArtistScript.php">

    <h1>Edit an artist that is already in the database.</h1>

    <br><br>

    <p>
        Artist name:
        <input type="text" name="artist" value = "<?php echo $printName?>"
               autofocus minlength="1" maxlength="99" required/>
    </p>

    <input type="hidden"  name="artID" value="<?php echo $temp?>"  required />

    <p>
        <input type="submit" value="Insert" />
    </p>
</form>



</body>
</html>