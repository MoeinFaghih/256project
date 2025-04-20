<?php
    session_start() ;
    if(isset($_POST["email"])){
        extract($_POST) ;
        //var_dump($_POST) ;
        if(!isset($otp) || $otp != $_SESSION["otp"]["code"])
        {
            $error = "Verification Code could not be Verified!" ;
        }elseif($otp == $_SESSION["otp"]["code"] && time()>$_SESSION["otp"]["expiry"]){
            $error = "Verification Code has been expired!" ;
        }
        else{
            require __DIR__ . "/../utility/db.php" ;
            $stmt = $db->prepare("insert into buyers (email, name, pass, city, district)
                                value(?,?,?,?,?)") ;
            $stmt->execute([$email, $name, password_hash($password, PASSWORD_BCRYPT), $city, $district]) ;
            
            header("location: login.php") ;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../market/msu.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
</head>
<body>
    <form action="" method="post">
        <div class="emailContainer">
            <p>email: <input type="text" name="email" id="email"></p>
            <div class="btn">Send Verification Code</div>
            
        </div>
        
        <p>name: <input type="text" name="name"></p>
        <p>city: <input type="text" name="city"></p>
        <p>district: <input type="text" name="district"></p>
        <p>password: <input type="password" name="password"></p>
        <button type="submit">sign up</button>
    </form>
    <div class="error">
        <?php if(isset($error))
            echo $error ;
        ?>
    </div>
</body>
<script>
    $(".btn").on("click", function(){
        
        const email = $("#email").val() ;
        //alert(`${email}`) ;
        fetch("./../market/otp-api.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({email: email})
        })
        .then(response => response.json())
        .then(data => {
            console.log(data) ;
        })

        $(".emailContainer").after('<p>verification code: <input type="text" name="otp"></p>')
    })
</script>
</html>