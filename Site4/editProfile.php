<?php
session_start();
include("logindb.php");

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $yearin = $_POST["yearin"];
    $graduate = $_POST["graduate"];
    $college = $_POST["college"];
    $degree = $_POST["degree"];
    $title = $_POST["title"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];

    $profile = $_SESSION["profile"];
    $userid = $profile["userid"];

    $profile_query = "UPDATE degrees_final SET yearin='$yearin', graduate='$graduate', college='$college', degree='$degree', title='$title' WHERE id='$userid'";
    $final_query = "UPDATE degrees_profile SET email='$email', phone='$phone', dob='$dob' WHERE userid='$userid'";

    mysqli_query($conn, $profile_query);
    mysqli_query($conn, $final_query);

    if(mysqli_error())
        $message = "Error: Connection to database unsuccessful";
    else
        $message = "Update Successful!";
}

$_SESSION["message"] = $message . "<br>";
header('Location: graduateprofile.php');

?>