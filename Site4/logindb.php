<?php // login.php
      // Change these details to suit your installation
  /*
  $hn = 'cssrvlab01.utep.edu';
  $db = 'cayub_db';
  $un = 'cayub';
  $pw = '*utep2018!';
  */
  $hn = 'cssrvlab01.utep.edu:3306';
  $db = 'hfierro2_db';
  $un = 'hfierro2';
  $pw = 'utep$321';
  $conn = new mysqli($hn, $un, $pw, $db); //mysqli research as not equal to mysql
  if ($conn->connect_error) die("Fatal Error!");
?>
