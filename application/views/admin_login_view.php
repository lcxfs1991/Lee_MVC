
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form action="<?php echo $_SERVER["REQUEST_URI"];?>" method="post">
            <table>
                <tr><td>User</td><td><input type="text" name="username"/></td></tr>
                <tr><td>Password</td><td><input type="password" name="password"/></td></tr>
                <tr><td><input type="submit" name="submit"/></td></tr>
            </table>
        </form>
    </body>
</html>
