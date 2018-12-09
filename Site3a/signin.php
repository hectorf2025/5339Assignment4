<?php
  echo <<<_END
<html>
    <body>
        <h1>Sign in</h1>
        <form action="user.php" method="post">
            User: <input type="text "name="username" required>
            </br>
            Password: <input type="password" name="password" required>
            </br>
            <input type="submit" value="Sign In">
        </form>
    </body>
</html>
_END;
?>