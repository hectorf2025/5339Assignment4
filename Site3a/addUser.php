<?php
    session_start();
    include("connect.php");

    $salt = "!@#$8301$%^&";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $newuser = $_POST["username"] . $_POST["password"];                 // Combine username and password
        $newuser = $salt . $newuser;                                        // Add salt to $newuser
        $newuser = hash('md5', $newuser, false);                            // Hash $newuser

        $sql = "SELECT * FROM accounts WHERE username = '$newuser'";        // Query $newuser
        $result = mysqli_query($conn, $sql);                                // Process query in DB
        
        $message = "";

        if (mysqli_num_rows($result) > 0) {                                 // Checks if the user already exists
            $message = "Existing user. Please use another username. </br>";
        } else {                                                            // Adds the new user
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $usertype = "";
            if ($_POST['user'] == "regular") {
                $usertype = 0;
            } else {
                $usertype = 1;
            }
            $sql = "INSERT INTO accounts (first_name, last_name, username, registration_date, login_date, administrator)
            VALUES ('$firstname', '$lastname', '$newuser', now(), now(), '$usertype')";

            if (mysqli_query($conn, $sql)) {
                $message = "New record created successfully";
            } else {
                $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    $_SESSION["message"] = $message;                                        // Warning message created
    
    mysqli_close($conn);
    header('Location: admin.php');
?>