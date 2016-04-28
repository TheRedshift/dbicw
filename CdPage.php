<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CDs</title>
</head>

<?php
include('background.php');
?>

<body>





<form action="addCD.php">

    <h1>Add a CD to the database.</h1> <br><br>
    <p>
        CD title:
        <input type="text" name="cd" />
    </p>

    <p>

        <!-- Modified from stackoverflow code - 23546818 -->
        <?php
        include 'db.php';
        $stmt = $conn->prepare("SELECT artName FROM artist");
        $stmt->execute();
        $array = [];


        foreach ($stmt->get_result() as $row)
        {
            $array[] = $row['artName'];
        }
        ?>
        Artist:
        <select name="artist" id="artist">
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
        CD Price (pennies):
        <input type="number" min = 0 step = 1 name = "price">
    </p>

    <p>
        Genre:
        <select name="genre">
            <option value="Rock">Rock</option>
            <option value="Pop">Pop</option>
            <option value="Classical">Classical</option>
            <option value="Rap">Rap</option>
        </select>
    </p>

    <p>
        Number of tracks:
        <input type="number" min = 1 name = "tracks">
    </p>

    <p>
        <input type="submit" value="Insert" />
    </p>
</form>

</body>
</html>

