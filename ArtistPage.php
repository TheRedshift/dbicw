<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artists</title>
</head>

<?php
include('background.php');
#include 'db.php';
?>

<body>




<form action="addArtist.php">

    <h1>Add an artist to the database.</h1> <br><br>

    <!-- Adapted from http://www.w3schools.com/php/php_mysql_select.asp -->
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

    $sql = "SELECT artID,artName FROM artist";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>artID</th><th>artName</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["artID"]."</td><td>".$row["artName"];
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <p>
        Artist name:
        <input type="text" name="artist" />
    </p>

    <p>
        <input type="submit" value="Insert" />
    </p>
</form>

</body>
</html>