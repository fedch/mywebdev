<!-- A page for searching a particular member based on their last name -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Member</title>
</head>
<body>
    <h1>Search Member</h1>
    <form method="post" action="member_search.php">
        <p>	<label for="lname">Last name: </label>
            <input type="text" name="lname" id="lname" /></p>
        <p>	<input type="submit" value="Search Member" /></p>
    </form>

    <?php
        // Get the information for the database connection
        require_once('../../settings/settings.php');

        // Ensure the form is submitted and the last name is not empty
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['lname'])) {
            $lname = $_POST['lname'];

        // Set up the SQL command to read the data from the table
        $query = "SELECT member_id, fname, lname, email
        FROM `vipmember` where lname like ?";

        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            $lname_search = "%$lname%";
            // Bind the parameter
            mysqli_stmt_bind_param($stmt, "s", $lname_search);
            
            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                // Check if there are any rows returned and display the data
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "Member ID: " . $row['member_id'] . "<br>";
                        echo "First Name: " . $row['fname'] . "<br>";
                        echo "Last Name: " . $row['lname'] . "<br>";
                        echo "Email: " . $row['email'] . "<br><br>";
                    }
                } else {
                    echo "No records found.";
                }
            } else {
                echo "Error executing query: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Unable to prepare statement: " . mysqli_error($conn);
            }
        }
    ?>
    <br><br>
    <a href="vip_member.php">Back to Home</a>
</body>