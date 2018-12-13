<?php
session_start();
include("logindb.php");

$_SESSION["message"] = "";
$salt = "!@#$8301$%^&";
$row = "";
$user = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION["username"] = cleanup_input($_POST["username"]);          // Cleans up entered username for login
    $_SESSION["password"] = $_POST["password"];                         // Captures password entered
    $user = $salt . $_SESSION["username"] . $_SESSION["password"];      // Combines username, password and adds a salt
    $user = hash('md5', $user, false);                                  // Hash $user

    $sql = "SELECT * FROM degrees_profile WHERE username = '$user'";           // Query $user
    $result = mysqli_query($conn, $sql);                                // Process query in DB

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $updateSql = "UPDATE degrees_profile SET login_date = now() WHERE username = '$user'";         // Update login time of $user
        mysqli_query($conn, $updateSql);
        $_SESSION["active"] = true;                                                   // Process update query
    } else {
        echo "Please log in with an existing user.";
        header("Location: signout.php");
    }
    $_SESSION["active"] = true;
} else {
    $user = $salt . $_SESSION["username"] . $_SESSION["password"];      // Combines username, password and adds a salt
    $user = hash('md5', $user, false);                                  // Hash $user

    $sql = "SELECT * FROM degrees_profile WHERE username = '$user'";           // Query $user
    $result = mysqli_query($conn, $sql);                                // Process query in DB

    $row = mysqli_fetch_assoc($result);
}

$_SESSION["profile"] = $row;
if ($row["administrator"] == 0) {
    $_SESSION["admin"] = false;
    header("Location: graduateprofile.php");
} else {
    $_SESSION["admin"] = true;
    header("Location: adminprofile.php");
}

function cleanup_input($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

mysqli_close($conn);

?>