<?php
    $serverName = "cssrvlab01.utep.edu";
    $username = "cayub";
    $password = "*utep2018!";
    $dbName = "cayub_db";

    $conn = mysqli_connect($serverName, $username, $password, $dbName);             // Establish connection with database (DB)

    if(!$conn) {                                                                    // Check connection with BD
        die("Connection failed: " . mysqli_connect_error());                        
    }
?>