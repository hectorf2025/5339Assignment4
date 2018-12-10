<?php
session_start();
include("connect.php");

$_SESSION["message"] = "";
$salt = "!@#$8301$%^&";
$row = "";
$user = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION["username"] = cleanup_input($_POST["username"]);          // Cleans up entered username for login
    $_SESSION["password"] = $_POST["password"];                         // Captures password entered
    $user = $salt . $_SESSION["username"] . $_SESSION["password"];      // Combines username, password and adds a salt
    $user = hash('md5', $user, false);                                  // Hash $user

    $sql = "SELECT * FROM accounts WHERE username = '$user'";           // Query $user
    $result = mysqli_query($conn, $sql);                                // Process query in DB

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $updateSql = "UPDATE accounts SET login_date = now() WHERE username = '$user'";         // Update login time of $user
        mysqli_query($conn, $updateSql);                                                        // Process update query
    } else {
        echo "Please log in with an existing user.";
    }
    $_SESSION["active"] = true;
} else {
    $user = $salt . $_SESSION["username"] . $_SESSION["password"];      // Combines username, password and adds a salt
    $user = hash('md5', $user, false);                                  // Hash $user

    $sql = "SELECT * FROM accounts WHERE username = '$user'";           // Query $user
    $result = mysqli_query($conn, $sql);                                // Process query in DB

    $row = mysqli_fetch_assoc($result);
}

$username = $_SESSION["username"];                                      // Saves username in a session variable

    echo <<<_END
<html>
    <body>
        <h2>Welcome $username! </h2>
        <form action="signout.php">
            <input type="submit" value="Sign Out">
        </form>
_END;
        echo "<h3> Personal Information </h3>";
        echo "<b>" . $row["first_name"] . " " . $row["last_name"] . "</b> </br> <i> Date of account creation: </i>" . $row["registration_date"] . "</br> <i>Last login: </i>" . $row["login_date"] . "</br>";
        
        if($row["administrator"] == 1) {
            $sql = "SELECT * FROM accounts";           // Query all users
            $result = mysqli_query($conn, $sql);       // Process query in DB

            echo <<<_END
            <form action="admin.php">
                <h3> List of Users </h3>
                <input type="submit" value="Add New User"/>
            </form>
_END;
            if(mysqli_num_rows($result)) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<b>" . $row["first_name"] . " " . $row["last_name"] . "</b> </br> <i> Date of account creation: </i>" . $row["registration_date"] . "</br> <i>Last login: </i>" . $row["login_date"] . "</br> <i>Admin Access: </i>" ;
                    if ($row["administrator"] == 1)
                        echo "Yes </br> </br>";
                    else 
                        echo "No </br> </br>";
                }
            }
        }

    echo <<<_END
    </body>
</html>
_END;


function cleanup_input($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

mysqli_close($conn);

?>