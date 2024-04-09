<!-- A page for showing all members -->

<!DOCTYPE html>	
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Members</title>
</head>
<body>
    <h1>Display Members</h1>
    <?php
        // Get the information for the database connection
        require_once('../../settings/settings.php');
        
        // Set up the SQL command to read the data from the table
        $query = "SELECT member_id, fname, lname 
        FROM `vipmember`";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "Couldn't read from the table: (" . mysqli_errno($conn) . ") " . mysqli_error($conn);
        } else {
            // Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
                // Loop through the rows and display the data
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "Member ID: " . $row['member_id'] . "<br>";
                    echo "First Name: " . $row['fname'] . "<br>";
                    echo "Last Name: " . $row['lname'] . "<br><br>";
                }
            } else {
                echo "No records found.";
            }
        }
        mysqli_close($conn);
    ?>
    <br><br>
    <a href="vip_member.php">Back to Home</a>
</body>