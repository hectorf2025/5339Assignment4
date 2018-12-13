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
    
    //$profile = $_SESSION["profile"];
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
        //echo "<input type='text' name='yearin'> <i>Classification: </i>" . $final["yearin"] . "</br>"; 
        //echo "<input type='text' name='graduate'> <i>Graduate: </i>" . $final["graduate"] . "</br>"; 
        //echo "<input type='text' name='college'> <i>College: </i>" . $final["college"] . "</br>"; 
        //echo "<input type='text' name='degree'> <i>Degree: </i>" . $final["degree"] . "</br>"; 
        //echo "<input type='text' name='title'> <i>Title: </i>" . $final["title"] . "</br>";
        echo "E-Mail:<input type='text' name='email' value=". $profile["email"] ." > </br>"; 
        echo "Phone:<input type='text' name='phone' value=". $profile["phone"] ."> </br>"; 
        echo "Date of birth:<input type='date' name='dob' value=". $profile["dob"] ."> </br>";

    echo <<<_END
            <input type="submit" value="Edit Profile">
            <input type="reset" value="Reset">
        </form>
        <form action="mainpage.php">
            <input type="submit" value="Back">
        </form>
        

_END;
        //Added to display profiles        
        $c[0] = "ID";
        $c[1] = "e-Mail";
        $c[2] = "Phone Number";
        $c[3] = "Date of Birth";  
        $f[0] = 'userid';
        $f[1] = 'email';
        $f[2] = 'phone';
        $f[3] = 'dob';
        $query2  = "SELECT * FROM degrees_profile WHERE userid != 0";
        grid2($conn, $query2, $f, $c);

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

function grid2($conn, $query, $f, $c){
    //echo "<br>".$query;
    $result = $conn->query($query);
    if (!$result){ 
        //die("<br>No records found in function grid1!!");
        echo '<script type="text/javascript">',
             'myAlert();',
             '</script>';
        return;
    }
    $rows = $result->num_rows;//result of query, store number of records as num_row is a field
    //Display records
    //echo "<table border='1' margin-left: 100px; font-family: verdana; font-size: 10px>";
    echo '<table id="graduates">';
    echo "<tr>";    
    //Display Headers with Column Names Selected 
    for ($i = 0 ; $i < sizeof($f); ++$i){
        if ($f[$i] != '')
            echo '<th>'.$c[$i].'</th>';
    }
    echo "</tr>";
    
    //Display records
    for ($j = 0 ; $j < $rows ; ++$j)
    { 
        echo "<tr>";
        for ($k = 0 ; $k < sizeof($f); ++$k){
            if ($f[$k] != ''){
                echo "<td>";
                    $result->data_seek($j);
                    echo htmlspecialchars($result->fetch_assoc()[$f[$k]]);
                echo "</td>";
            }
        }
      echo "</tr>";
    }              
    echo "</table>";
    
    $result->close();
    $conn->close();
    return;
}
?>