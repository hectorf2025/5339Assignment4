<?php
    session_start();
    include("logindb.php");

    $salt = "!@#$8301$%^&";


            // $newuser = "jperez" . "12345";
            // $newuser = $salt . $newuser;                                        // Add salt to $newuser
            // $newuser = hash('md5', $newuser, false); 
            // $userid = '123456';
            // $email = 'jperez@miners.utep.edu';
            // $phone = '915 246 4560';
            // $usertype = 0;
            // $sql = "INSERT INTO degrees_profile (userid, email, phone, dob, username, registration_date, login_date, administrator)
            // VALUES ('$userid', '$email', '$phone', now(), '$newuser', now(), now(), '$usertype')";
            // mysqli_query($conn, $sql);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $newuser = $_POST["username"] . $_POST["password"];                 // Combine username and password
        $newuser = $salt . $newuser;                                        // Add salt to $newuser
        $newuser = hash('md5', $newuser, false);                            // Hash $newuser

        $sql = "SELECT * FROM degrees_profile WHERE username = '$newuser'";        // Query $newuser
        $result = mysqli_query($conn, $sql);                                // Process query in DB
        
        $message = "";

        if (mysqli_num_rows($result) > 0) {                                 // Checks if the user already exists
            $message = "Existing user. Please use another username. </br>";
        } else {                                                            // Adds the new user
            $userid = $_POST['userid'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $dateOfBirth = $_POST['dob'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];

            $usertype = "";
            if ($_POST['user'] == "regular") {
                $usertype = 0;
            } else {
                $usertype = 1;
            }
            $sql = "INSERT INTO degrees_profile (userid, email, phone, dob, username, registration_date, login_date, administrator)
            VALUES ('$userid', '$email', '$phone', '$dateOfBirth', '$newuser', now(), now(), '$usertype')";

            $sqlTwo = "INSERT INTO degrees_final (id, fname, lname)
            VALUES ('$userid', '$firstname', '$lastname')";

            if (mysqli_query($conn, $sql) && mysqli_query($conn, $sqlTwo)) {
            // if ($conn->query($sql)) {
                $message = "New record created successfully";
            } else {
                $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    $_SESSION["message"] = $message;                                        // Warning message created
    
    mysqli_close($conn);
    header('Location: adminprofile.php');
?>