<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search results</title>
    <link rel="stylesheet" type="text/css" href="homepage.css">
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


if ($result && $result->num_rows > 0) {
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

<span class="prev">
  Previous
</span>

<span class="next">
  Next
</span>

<script>


    var maxRows = 5;

    $('table').each(function() {
        var cTable = $(this);
        var cRows = cTable.find('tr:gt(0)');
        var cRowCount = cRows.size();

        if (cRowCount < maxRows) {
            return;
        }

        cRows.each(function(i) {
            $(this).find('td:first').text(function(j, val) {
                return (i + 1) + " - " + val;
            });
        });

        cRows.filter(':gt(' + (maxRows - 1) + ')').hide();


        var cPrev = cTable.siblings('.prev');
        var cNext = cTable.siblings('.next');

        cPrev.addClass('disabled');

        cPrev.click(function() {
            var cFirstVisible = cRows.index(cRows.filter(':visible'));

            if (cPrev.hasClass('disabled')) {
                return false;
            }

            cRows.hide();
            if (cFirstVisible - maxRows - 1 > 0) {
                cRows.filter(':lt(' + cFirstVisible + '):gt(' + (cFirstVisible - maxRows - 1) + ')').show();
            } else {
                cRows.filter(':lt(' + cFirstVisible + ')').show();
            }

            if (cFirstVisible - maxRows <= 0) {
                cPrev.addClass('disabled');
            }

            cNext.removeClass('disabled');

            return false;
        });

        cNext.click(function() {
            var cFirstVisible = cRows.index(cRows.filter(':visible'));

            if (cNext.hasClass('disabled')) {
                return false;
            }

            cRows.hide();
            cRows.filter(':lt(' + (cFirstVisible +2 * maxRows) + '):gt(' + (cFirstVisible + maxRows - 1) + ')').show();

            if (cFirstVisible + 2 * maxRows >= cRows.size()) {
                cNext.addClass('disabled');
            }

            cPrev.removeClass('disabled');

            return false;
        });

    });


</script>

<br><br>



</body>
</html>

