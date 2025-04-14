<?php
    session_start() ;
    require "./protect.php" ;

    extract($_SESSION["user"]) ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <p>email: <input type="text" name="email"></p>
        <p>name: <input type="text" name="name"></p>
        <p>city: <input type="text" name="city"></p>
        <p>district: <input type="text" name="district"></p>
        <p>password: <input type="password" name="password"></p>
        <button type="submit">sign up</button>
    </form>
</body>
</html>