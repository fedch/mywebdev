<!-- A page for adding new members - html form -->

<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
    <head>
        <title>MySQL Databases with PHP</title>
    </head>

    <body>
        <h1>Add Member Form</h1>
        <form method="post" action="member_add.php">
            <p>	<label for="fname">First name: </label>
                <input type="text" name="fname" id="fname" /></p>
            <p>	<label for="lname">Last name: </label>
                <input type="text" name="lname" id="lname" /></p>
            <p>	<label for="gender">Gender m/f: </label>
                <input type="text" name="gender" id="gender" /></p>
            <p>	<label for="email">Email: </label>
                <input type="text" name="email" id="email" /></p>
            <p>	<label for="phone">Phone: </label>
                <input type="text" name="phone" id="phone" /></p>
            <p>	<input type="submit" value="Add Member" /></p>
        </form>
    </body>
    </html>