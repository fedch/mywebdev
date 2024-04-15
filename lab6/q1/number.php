<?php
    // start the session
    session_start();
    // check if the session variable exists
    if(!isset($_SESSION['number'])) {
        // create the session variable
        $_SESSION['number'] = 0;
    }
    // copy the session variable to a local variable
    $num = $_SESSION['number'];
    ?>
    <html>
        <head>
            <title>Managing Session</title>
        </head>
        <body>
            <h1>Web Development</h1>
            <?php
            // Display the number
                echo "<p>Number: $num</p>";
            ?>
            <p><a href="numberup.php">Up</a></p> 
            <p><a href="numberdown.php">Down</a></p>
            <p><a href="numberreset.php">Reset</a></p>
        </body>
    </html>

