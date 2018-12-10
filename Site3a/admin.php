<?php
session_start();

$message = $_SESSION["message"];
echo $message;
$username = $_SESSION["username"];

    echo <<<_END
<html>
    <body>
        <h2>Admin page</h2>
        <form action="signout.php">
            <b>Hello $username</b> <input type="submit" value="Sign Out">
        </form>
        <form action="addUser.php" method="post">
            Name: <input type="text "name="firstname" required>
            </br>
            Lastname: <input type="text" name="lastname" required>
            </br>
            Username: <input type="text" name="username" required>
            </br>
            Password: <input type="text" name="password" required>
            </br>
            <input type="radio" id="user" name="user" value="admin" required> Administrator
            <input type="radio" id="user" name="user" value="regular" required> Regular User </br>

            <input type="submit" value="Submit">
            <input type="reset" value="Clear">            
        </form>
        <form action="user.php">
            <input type="submit" value="Back">
        </form>
    </body>
</html>
_END;
?>