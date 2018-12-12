<?php
    //$serverName = "cssrvlab01.utep.edu";
    //$username = "cayub";
    //$password = "*utep2018!";
    //$dbName = "cayub_db";
    $serverName = 'cssrvlab01.utep.edu:3306';
    $dbName = 'hfierro2_db';
    $username = 'hfierro2';
    $password = 'utep$321';

    $conn = mysqli_connect($serverName, $username, $password, $dbName);             // Establish connection with database (DB)

    if(!$conn) {                                                                    // Check connection with BD
        die("Connection failed: " . mysqli_connect_error());                        
    }
?>