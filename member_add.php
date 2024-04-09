<!-- A page for adding new members -->

<!DOCTYPE html>

    <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
    <head>
    <title>MySQL Databases with and PHP</title>
    </head>

    <body>
        <?php
            require_once('../../settings/settings.php');

            // Upon successful connection
            // Create table if doesn't exists
            $query = "CREATE TABLE IF NOT EXISTS `vipmember` (
            `member_id` int unsigned NOT NULL auto_increment,
            `fname` varchar(40) NOT NULL,
            `lname` varchar(40) NOT NULL,
            `gender` varchar(1) NOT NULL,
            `email` varchar(40) NOT NULL,
            `phone` varchar(20) NOT NULL,
            PRIMARY KEY  (`member_id`)
            )";

            if (!mysqli_query($conn, $query)) {
                echo "Table creation failed: (" . mysqli_errno($conn) . ") " . mysqli_error($conn);
            } else {
                echo "Table checked/created successfully";
            }

            // Get data from the form
            $fname  = $_POST["fname"];
            $lname	= $_POST["lname"];
            $gender	= $_POST["gender"];
            $email	= $_POST["email"];
            $phone	= $_POST["phone"];
            

            // Set up the SQL command to add the data into the table
            // Ensuring protection from sql injections
            $query = "INSERT INTO `vipmember` 
            (fname, lname, gender, email, phone) 
            VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $gender, $email, $phone);

                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    echo "<p>Success</p>";
                } else {
                    echo "<p>Error: " . mysqli_error($conn) . "</p>";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                echo "<p>Unable to prepare statement: " . mysqli_error($conn) . "</p>";
            }

                // close the database connection
                mysqli_close($conn);
        ?>
        <br><br>
        <a href="vip_member.php">Back to Home</a>
    </body>