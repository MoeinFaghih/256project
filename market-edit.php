<?php
    session_start() ;

    require "./protect.php" ;

    if($_SERVER["REQUEST_METHOD"] === "POST"){   //validation to be done here
        require "./db.php" ;
        extract($_POST) ;
        $qs = "update markets
                set
                    email = ?,
                    name = ?,
                    city = ?,
                    district = ?
                where email = ? 
                " ;
        $stmt = $db->prepare($qs) ;
        $stmt->execute([$email, $name, $city, $district, $_SESSION["user"]["email"]]) ;
        
        $_SESSION["user"]["name"] = $name ;
        $_SESSION["user"]["email"] = $email ;
        $_SESSION["user"]["city"] = $city ;
        $_SESSION["user"]["district"] = $district ;


        header("location: marketMain.php") ;
        exit;
    }

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
        <p>email: <input type="text" name="email" value="<?= $email ?>"></p>
        <p>name: <input type="text" name="name" value="<?= $name ?>"></p>
        <p>city: <input type="text" name="city" value="<?= $city ?>"></p>
        <p>district: <input type="text" name="district"  value="<?= $district ?>"></p>
        <button type="submit">Submit Changes</button>
    </form>

    <br><br>

    <a href="market-change-pass.php">Change Password</a>
</body>
</html>