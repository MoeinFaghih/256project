<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        require __DIR__ . "/../utility/db.php" ;
        require __DIR__ . "/../utility/lib.php" ;
        extract($_POST) ;
        session_start() ;

        
        getMarketByEmail($email, $user) ;
        if($user && password_verify($password, $user["pass"])){
                $_SESSION["buyer"] = $user ;
                header("location: index.php") ;
        }
        else{
            $failed = true ;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Login</h3>
    <form action="" method="post">
        <p>email: <input type="text" name="email" id=""></p>
        <p>password: <input type="password" name="password" id=""></p>
        <button type="submit">login</button>
    </form>

    <a href="./signUp.php">Sign Up</a>

    <?php if(isset($failed)):?>
        <h3>Wrong Credentials!</h3>
    <?php endif ?>

</body>
</html>