<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tracks</title>
</head>

<?php
include('background.php');
?>

<body>


<form action="addTrack.php">

    <h1>Add a track to the database.</h1> <br><br>
    <p>
        Track title:
        <input type="text" name="track" />
    </p>

    <p>

        <!-- Modified from stackoverflow code - 23546818 -->
        <?php
        include 'db.php';
        $stmt = $conn->prepare("SELECT cdTitle FROM cd");
        $stmt->execute();
        $array = [];


        foreach ($stmt->get_result() as $row)
        {
            $array[] = $row['cdTitle'];
        }
        ?>
        CD:
        <select name="cd" id="cd">
        <option selected="selected">Choose one</option>

            <?php

            foreach($array as $key =>$value)
            {?>

            <option value="<?=$value?>"><?=$value?></option>
            <?php
    } ?>
        </select>

    </p>


    <p>
        Track runtime(seconds) :
        <input type="number" min =0 step = 1 name="runtime" />
    </p>

    <p>
        <input type="submit" value="Insert" />
    </p>
</form>

</body>
</html>