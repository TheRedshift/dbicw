<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <title>Artists</title>
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>

</head>



<?php
include('background.php');
#include 'db.php';
if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
    // treat the success case ex:
    $message = "Artist Successfully added!";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == -1 )
{
    $message = "Something appears to have gone wrong - please try again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == -2 )
{
    $message = "Deleting entry failed - are you sure there are no cds on the system with this artist?";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == 2 )
{
    $message = "Entry successfully deleted.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == -3 )
{
    $message = "Editing entry failed - please try again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else if ( isset($_GET['success']) && $_GET['success'] == 3 )
{
    $message = "Entry successfully edited.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}

?>

<body >



<form action="addArtist.php">



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
        echo "<table id='table'><tr><th>artID</th><th>artName</th><th>Albums</th>
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




    <!-- Adapted from jqueryscript.net -->

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
            var iRows = cTable.find('tr:gt(0)');
            var cRowCount = iRows.size();

            if (cRowCount < maxRows) {
                return;
            }

            iRows.each(function(i) {
                $(this).find('td:first').text(function(j, val) {
                    return val;
                });
            });

            iRows.filter(':gt(' + (maxRows - 1) + ')').hide();


            var cPrev = cTable.siblings('.prev');
            var cNext = cTable.siblings('.next');

            cPrev.addClass('disabled');

            cPrev.click(function() {
                var cFirstVisible = iRows.index(iRows.filter(':visible'));

                if (cPrev.hasClass('disabled')) {
                    return false;
                }

                iRows.hide();
                if (cFirstVisible - maxRows - 1 > 0) {
                    iRows.filter(':lt(' + cFirstVisible + '):gt(' + (cFirstVisible - maxRows - 1) + ')').show();
                } else {
                    iRows.filter(':lt(' + cFirstVisible + ')').show();
                }

                if (cFirstVisible - maxRows <= 0) {
                    cPrev.addClass('disabled');
                }

                cNext.removeClass('disabled');

                return false;
            });

            cNext.click(function() {
                var cFirstVisible = iRows.index(iRows.filter(':visible'));

                if (cNext.hasClass('disabled')) {
                    return false;
                }

                iRows.hide();
                iRows.filter(':lt(' + (cFirstVisible +2 * maxRows) + '):gt(' + (cFirstVisible + maxRows - 1) + ')').show();

                if (cFirstVisible + 2 * maxRows >= iRows.size()) {
                    cNext.addClass('disabled');
                }

                cPrev.removeClass('disabled');

                return false;
            });

        });


    </script>

    <br><br>

    <h1>Add an artist to the database-</h1>

    <br><br>

    <p>
        Artist name:
        <input type="text" name="artist" autofocus minlength="1" maxlength="99" required/>
    </p>

    <p>
        <input type="submit" value="Confirm" />
    </p>
</form>



</body>
</html>