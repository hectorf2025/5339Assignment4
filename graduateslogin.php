<?php // login.php
    echo '<form name="login" action="graduateprofile.php" method="post">';
    echo 'Login Graduates Page<br>';
    echo 'User Name:<br><input type="text" name="user"><br>';
    //Password expression. 
    //Password must be between 4 and 8 digits long and include at least one numeric digit.
    echo 'Password:<br><input type="text" name="password" pattern=""><br>';
    echo '<input type="submit">';
?>