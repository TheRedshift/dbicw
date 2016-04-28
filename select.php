<html><body>
<?php
include 'db.php'; // include our database connection
$sql = "SELECT * FROM message";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($messageSender, $messageText);
while ($stmt->fetch()) {
    echo "<p>";
    echo "<b>" . htmlentities($messageSender) . "</b>: ";
    echo htmlentities($messageText);
    echo "</p>";
}
?>
</body></html>
