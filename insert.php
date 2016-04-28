<?php
/**
 * Created by PhpStorm.
 * User: Rahul Soni
 * Date: 28/04/2016
 * Time: 10:57
 */

include 'db.php'; // include our database connection
$artistName = $_GET['artist'];
$sql = "INSERT INTO artist (artName) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $artistName);
$result = $stmt->execute();
if (!$result) echo "failed to insert record";
