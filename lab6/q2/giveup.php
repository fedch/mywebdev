<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Give Up</title>
</head>
<body>
    <p>The hidden number was: <?php echo isset($_SESSION['randNum']) ? $_SESSION['randNum'] : "Not set"; ?></p>
    <a href="startover.php">Try Again?</a>
</body>
</html>
