<?php // profile.php
  if (isset($_POST['user'])) $user = sanitizeString($_POST['user']);
  else $user = '';
  
  if (user != ""){
    require_once 'logindb.php';
    $conn = new mysqli($hn, $un, $pw, $db); //mysqli research as not equal to mysql
    if ($conn->connect_error) die("Fatal Error!");
  }

  $c[0] = "userid";
  $c[1] = "email";
  $c[2] = "phone";
  $c[3] = "dob";      
 
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
	
    echo '<form name="profiles" action="graduateslogin" method="post">';
    echo '<pre>';
    echo '<p>';
    echo 'Fields to Display :';
    echo '</p>';
    //echo '<input type="submit">';    
    echo '<input type="submit" value="Edit Profile">';

    echo '</pre>';
    echo '</form>';

    $query2  = "SELECT * FROM degrees_profile WHERE userid = ".$user;
    grid1($conn, $query2, $c);        
    
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
    
 
    function grid1($conn, $query, $c){
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
        
        //echo "<tr>";    
        //Display Headers with Column Names Selected 
        //for ($i = 0 ; $i < sizeof($c); ++$i){
            //echo '<th>'.$c[$i].'</th>';
        //}
        //echo "</tr>";
        
        //Display records
        for ($j = 0 ; $j < $rows ; ++$j)
        { 
            echo "<tr>";
            for ($k = 0 ; $k < sizeof($c); ++$k){
                if ($c[$k] != ''){
                    //echo "<td>";
                        $result->data_seek($j);
                        //echo htmlspecialchars($result->fetch_assoc()[$c[$k]]);
                        $r = htmlspecialchars($result->fetch_assoc()[$c[$k]]);
                        //echo "r = ".$r."<br>";
                        //echo $c[$k];
                        echo $c[$k]."   :";
                        echo '<input type="text" name='.$c[$k].' value= '.$r.' disabled>';
                        echo "<br>";
                        // <textarea name='.$c[$k].' disabled>';
                    //echo "</td>";
                }
            }
          echo "</tr>";
        }              
        echo "</table>";
        
        $result->close();
        $conn->close();
        return;
    }
  
   
  function sanitizeString($var)
    {
        if (get_magic_quotes_gpc())
            $var = stripslashes($var);
            $var = htmlentities($var);
            $var = strip_tags($var);
            return $var;
    }
    
?>