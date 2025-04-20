<?php
    session_start() ;
    require "./protect_buyer.php" ;
    extract($_SESSION) ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?= $buyer["name"] ?>
        <br>
        <?= $buyer["city"] ?>
        <hr>
        <form action="" method="post">
            <input type="text" name="keyword">
            <button type="submit">search</button>
        </form>
    </div>
    <form action=""></form>
</body>
</html>