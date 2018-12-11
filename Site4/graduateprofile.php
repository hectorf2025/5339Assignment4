<?php // profile.php
session_start();
include("logindb.php");
 
echo <<<_ENDH
        <html>
           <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style>
            body {
            background-color: D7E4EF;
            }
  
            h1 {
                color: 092A46;
                text-align: center;
                border-bottom: 6px  176299;
            }

            p {
                margin-left: 100px;
                font-family: verdana;
                font-size: 14px;
                
            }
            p2 {
                margin-left: 100px;
                font-family: verdana;
                font-size: 12px;
                
            }
  
            p3 {
                margin-left: 100px;
                font-family: verdana;
                font-size: 10px;
                
            }
  
            #graduates {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #graduates td, #graduates th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #graduates tr:nth-child(even){background-color: #f2f2f2;}
            
            #graduates tr:hover {background-color: #ddd;}
  
            #graduates th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #082F4F;
                color: white;
            }
  
            </style>
  
               <title>CS 4339/5339 PHP assignment 3</title>
           </head>
           <h1>CS graduates profile</h1>
           <body> 
               
_ENDH;
    $message = $_SESSION["message"];
    echo $message;
    $profile = $_SESSION["profile"];
    
    echo "<h3> Hello " . $_SESSION["username"] . "</h3>";

    echo <<<_END
        <form action="signout.php">
            <input type="submit" value="Logout">
        </form>
_END;
    
    $profile = $_SESSION["profile"];
    $query  = "SELECT * FROM degrees_final WHERE id = ".$profile['userid'];
    $result = mysqli_query($conn, $query);
    $final = mysqli_fetch_assoc($result);

    echo <<<_END
        <form action="editProfile.php" method='post'>
        <h3> Personal Information </h3>
_END;

        echo "<b>" . $final["fname"] . " " . $final["lname"] . "</b> </br>";
        echo "<i>Date of account creation: </i>" . $profile["registration_date"] . "</br>"; 
        echo "<i>Last login: </i>" . $profile["login_date"] . "</br>";
        echo "<input type='text' name='yearin'> <i>Classification: </i>" . $final["yearin"] . "</br>"; 
        echo "<input type='text' name='graduate'> <i>Graduate: </i>" . $final["graduate"] . "</br>"; 
        echo "<input type='text' name='college'> <i>College: </i>" . $final["college"] . "</br>"; 
        echo "<input type='text' name='degree'> <i>Degree: </i>" . $final["degree"] . "</br>"; 
        echo "<input type='text' name='title'> <i>Title: </i>" . $final["title"] . "</br>";
        echo "<input type='text' name='email'> <i>E-Mail: </i>" . $profile["email"] . "</br>"; 
        echo "<input type='text' name='phone'> <i>Phone: </i>" . $profile["phone"] . "</br>"; 
        echo "<input type='date' name='dob'> <i>Date of birth: </i>" . $profile["dob"] . "</br>";

    echo <<<_END
            <input type="submit" value="Edit Profile">
            <input type="reset" value="Reset">
        </form>
        <form action="mainpage.php">
            <input type="submit" value="Back">
        </form>
_END;
    echo <<<_ENDF
            </pre>
            
            <script>
            function myAlert() {
                alert("No records found in Graduate Table!!");
            }
            </script>
    
   
            </body>
        </html> 
_ENDF;
    
?>