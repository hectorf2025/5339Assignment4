<?php // query.php
  if (isset($_POST['id'])) $f[0] = sanitizeString($_POST['id']);
  else $f[0] = '';
  
  if (isset($_POST['yearin'])) $f[1] = sanitizeString($_POST['yearin']);
  else $f[1] = '';
  
  if (isset($_POST['graduate'])) $f[2] = sanitizeString($_POST['graduate']);
  else $f[2] = '';
  
  if (isset($_POST['lname'])) $f[3] = sanitizeString($_POST['lname']);
  else $f[3] = ''; 

  if (isset($_POST['fname'])) $f[4] = sanitizeString($_POST['fname']);
  else $f[4] = '';
  
  if (isset($_POST['college'])) $f[5] = sanitizeString($_POST['college']);
  else $f[5] = '';
  
  if (isset($_POST['degree'])) $f[6] = sanitizeString($_POST['degree']);
  else $f[6] = '';
  
  if (isset($_POST['title'])) $f[7] = sanitizeString($_POST['title']);
  else $f[7] = '';

  if (isset($_POST['orderby'])) $ob = sanitizeString($_POST['orderby']);
  else $ob = '';
    
  if (isset($_POST['sort'])) $s = sanitizeString($_POST['sort']);
  //else $s = '';
  
  if (isset($_POST['rowsperpage'])) $rowspp = sanitizeString($_POST['rowsperpage']);
  //else $s = '';
  
  if (isset($_POST['page'])) $pg = sanitizeString($_POST['page']);
  else $pg = 1;

  if (isset($_POST['columns'])) $cols = sanitizeString($_POST['columns']);
  else $cols = "";
  
  require_once 'logindb.php';
  $conn = new mysqli($hn, $un, $pw, $db); //mysqli research as not equal to mysql
  if ($conn->connect_error) die("Fatal Error!");
  
  $c[0] = "ID";
  $c[1] = "Year In";
  $c[2] = "Graduate";
  $c[3] = "Last Name";      
  $c[4] = 'First Name';
  $c[5] = 'College'; 
  $c[6] = 'Degree';
  $c[7] = 'Title';
  
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
           <h1>CS graduates spreadsheet Grid</h1>
           <body> 
               
_ENDH;
	
    echo '<form name="graduates" action="sql10-hfierro2.php" method="post">';
    echo '<pre>';
    echo '<p>';
    echo 'Select Fields to Display on Grid:';
    echo '</p>';
    
    echo '<p2>';
    if (!empty($_POST['id'])) $checked1="checked"; else $checked1= "";
    echo '<input type="checkbox" name="id" value="id"'.$checked1.'/>ID';
    echo '<br>';
    echo '</p2>';
    
    echo '<p2>';
    if (!empty($_POST['yearin'])) $checked1="checked"; else $checked1= "";
    echo '<input type="checkbox" name="yearin" value="yearin"'.$checked1.'/>Year In';
    echo '<br>';
    echo '</p2>';
    
    echo '<p2>';
    if (!empty($_POST['graduate'])) $checked2="checked"; else $checked2= "";
    echo '<input type="checkbox" name="graduate" value="graduate"'.$checked2.'/>Graduate';
    echo '<br>';
    echo '</p2>';
    
    echo '<p2>';
    if (!empty($_POST['lname'])) $checked3="checked"; else $checked3= "";
    echo '<input type="checkbox" name="lname" value="lname"'.$checked3.'/>Last Name'; 
    echo '<br>';
    echo '</p2>';
    
    echo '<p2>';
    if (!empty($_POST['fname'])) $checked4="checked"; else $checked4= "";
    echo '<input type="checkbox" name="fname" value="fname"'.$checked4.'/>First Name';
    echo '<br>';
    echo '</p2>';
    
    echo '<p2>';
    if (!empty($_POST['college'])) $checked5="checked"; else $checked5= "";
    echo '<input type="checkbox" name="college" value="college"'.$checked5.'/>College';
    echo '<br>';
    echo '</p2>';
    
    echo '<p2>';
    if (!empty($_POST['degree'])) $checked6="checked"; else $checked6= "";
    echo '<input type="checkbox" name="degree" value="degree"'.$checked6.'/>Degree';
    echo '<br>';
    echo '</p2>';
    
    echo '<p2>';
    if (!empty($_POST['title'])) $checked7="checked"; else $checked7= "";
    echo '<input type="checkbox" name="title" value="title"'.$checked7.'/>Title';       
    echo '<br>';
    echo '</p2>';
    
    echo '<br>';
        echo '<p>';
        echo "Select a Field to Order By:";
        echo '</p>';
    
        if (isset($_POST['sort'])) $s = sanitizeString($_POST['sort']);
        echo '<p2>';
        echo '<input type="radio" name="orderby" value="id" checked>ID';
        echo '<input type="radio" name="orderby" value="graduate"  >Graduate';
        echo '<input type="radio" name="orderby" value="lname"     >Last Name';
        echo '<input type="radio" name="orderby" value="fname"     >First Name';
        echo '<input type="radio" name="orderby" value="college"   >College';
        echo '</p2>';
    
        echo '<br>';
        echo '<p>';
        echo "Select Sort:";
        echo '</p>';
        echo '<p2>';
        echo '<input type="radio" name="sort" value="asc" checked>Ascending<input type="radio" name="sort" value="desc">Descending'; 
        echo '<br>';
        echo '</p2>';
        echo '<p>';
        echo 'Select how many rows to display?';
	echo '<select name="rowsperpage">';
            echo '<option value="All">Select All</option>';
            echo '<option value=10>10</option>';
            echo '<option value=25>25</option>';
            echo '<option value=50>50</option>';
            echo '<option value=100>100</option>';
          
	echo '</select>';
        echo '<p>';
        
        echo "<input type='hidden' name='checkcolumns' value='yes'>";
        echo '<input type="submit">';    
        
    echo '</pre>';
    echo '</form>';                  
 
    //First time page loads display all records AND 5 COLUMNS
    if (! isset($_POST['checkcolumns']))
    {
        $f[0] = 'id';
        $f[2] = 'graduate';
        $f[3] = 'lname';
        $f[4] = 'fname';
        $f[5] = 'college';
        $query2  = "SELECT * FROM degrees_final";
        grid1($conn, $query2, $f, $c);        
    }
    
    echo <<<_ENDF
            </pre>
            <script>
                // When the user clicks on div, open the popup
                function myFunction() {
                    var popup = document.getElementById("myPopup");
                    popup.classList.toggle("show");
                }
            </script>
    
            <script>
            function myAlert() {
                alert("No records found in Graduate Table!!");
            }
            </script>
    
   
            </body>
        </html> 
_ENDF;
    
 
    function grid1($conn, $query, $f, $c){
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
        //$conn->close();
        return;
    }
  
  //if columns are selected build the query string
  //after clicked Submit
  if (isset($_POST['checkcolumns'])){
    $comma = 0;
    $order =0;
    for ($i = 0 ; $i < sizeof($f); ++$i)
    {
        if ($f[$i] != ''){
           if ($ob == $f[$i])
               $order = 1;
           if ($comma > 0){
               $columns = $columns.', ';
           }
           $columns = $columns.$f[$i];        
           $comma++;           
        }
    }
    //echo "Check Columns: ".$columns;
    
    $query  = "SELECT ".$columns." FROM degrees_final";
    //if ($ob != '')
    if ($order == 1)
         $query = $query." ORDER BY ".$ob." ".$s;
    
    $page1 = pagination();

    if ($rowspp !== "All")
        $query2 = $query." LIMIT ".$page1.", ".$rowspp;
    else
        $query2 = $query;
            
    grid1($conn, $query2, $f, $c);    
  }  
   
  function pagination(){
        $r2 =$rowspp;
        
        if(pg == 1){
            $pg = $pg +1;          
            //echo "<br>Pagination Page: ".$pg;
        }else {
            $pg = 1;
            //echo "<br>Pagination: ".$page;
        }
        
        if ($pg =='' || $pg ==1){
            $page1 = 0;
        }else{
            $page1 = ($pg*r2)-r2;
        }        
        return $page1;
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