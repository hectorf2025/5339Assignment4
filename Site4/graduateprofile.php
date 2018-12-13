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
            
            .signup {
              border:1px solid #4C668C;
              font:  normal 14px helvetica;
              color: #444444;
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
    
    //echo "<h3> Hello " . $_SESSION["username"] . "</h3>";
    echo <<<_END
    <table width="400" align="center" class="signup" border="0" cellpadding="2" cellspacing="5" bgcolor="#B9BEC4">
      <th colspan="2" align="center">Signed up as regular user</th>
_END;

        echo "<tr><td>Date of account creation:</td>  
              <td>".$profile["registration_date"]."</td></tr>"; 
        echo "<tr><td>Last login: </td>  
              <td>".$profile["login_date"]."</td></tr>";
    echo <<<_END
      
        <form action="signout.php"></td></tr>
            <tr><td colspan="2" align="center"><input type="submit" value="Logout"></td></tr>
        </form>
        
        <form action="mainpage.php">
            <tr><td colspan="2" align="center"><input type="submit" value="Back"></td></tr>
        </form>
    </table>
    
    <table width="400" align="center" class="signup" border="0" cellpadding="2" cellspacing="5" bgcolor="#B9BEC4">
      <th colspan="2" align="center">Edit Profile Form</th>
      <form method="post" action="editProfile.php">
_END;

    $profile = $_SESSION["profile"];
        $query  = "SELECT * FROM degrees_final WHERE id = ".$profile['userid'];
    $result = mysqli_query($conn, $query);
    $final = mysqli_fetch_assoc($result);

        echo "<tr><td>ID</td>  
              <td><input type='text' maxlength='11' name='userid' value=".$profile['userid']." disabled></td></tr>";
        echo "<tr><td>User Name</td>  
              <td><input type='text' maxlength='20' name='username' value=".$_SESSION["username"]." disabled></td></tr>";
        echo "<tr><td>Forename</td>  
              <td><input type='text' maxlength='35' name='fname' value=".$final['fname']." disabled></td></tr>";
        echo "<tr><td>Surname</td>
              <td><input type='text' maxlength='35' name='lname' value=".$final['lname']." disabled></td></tr>";
        echo "<tr><td> e-mail</td>  
              <td><input type='text' maxlength='25' name='email' value=".$profile['email']."></td></tr>";
        echo "<tr><td>Phone</td>";
        echo "  <td><input type='text' maxlength='12' name='phone' value=".$profile['phone']."></td></tr>";
        echo "<tr><td>Date of Birth</td>";
        echo "<td><input type='date' name='dob' value=".$profile['dob']."></td></tr>";
        
        echo <<<_END
          <tr><td colspan="2" align="center"><input type="submit" value="Update Profile"></td></tr>
          <tr><td colspan="2" align="center"><input type="reset" value="Reset"></td></tr>
        
      </form>
    </table>
    
_END;
        /*
        echo "<b>" . $final["fname"] . " " . $final["lname"] . "</b> </br>";
        echo "       E-Mail: <input type='text' name='email' value=". $profile["email"] ." ><br>"; 
        echo "        Phone: <input type='text' name='phone' value=". $profile["phone"] ."><br>"; 
        echo "Date of birth:<input type='date' name='dob' value=". $profile["dob"] ."><br>";
        
        echo "<i>Date of account creation: </i>" . $profile["registration_date"] . "</br>"; 
        echo "<i>Last login: </i>" . $profile["login_date"] . "</br>";
        
        echo <<<_END
            <input type="submit" value="Edit Profile">
            <input type="reset" value="Reset">
        </form>
        <form action="mainpage.php">
            <input type="submit" value="Back">
        </form>
_END;*/
        //Added to display profiles        
        $c[0] = "ID";
        $c[1] = "Name";
        $c[2] = "Last Name";
        $c[3] = "e-Mail";
        $c[4] = "Phone Number";
        $c[5] = "Date of Birth";  
        
        $f[0] = 'userid';
        $f[1] = 'fname';
        $f[2] = 'lname';
        $f[3] = 'email';
        $f[4] = 'phone';
        $f[5] = 'dob';
        //$query2  = "SELECT * FROM degrees_profile";
        
        $query2 = "SELECT degrees_profile.userid, degrees_final.fname, degrees_final.lname, 
        degrees_profile.email, degrees_profile.phone, degrees_profile.dob
        FROM degrees_profile INNER JOIN degrees_final 
        ON degrees_profile.userid = degrees_final.id ORDER BY degrees_profile.userid";
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