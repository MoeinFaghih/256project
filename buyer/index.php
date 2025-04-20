<?php
    session_start() ;
    require "./protect_buyer.php" ;
    extract($_SESSION) ;
    require "../utility/db.php" ;

    if(isset($_POST["keyword"])){
        $stmt = $db->prepare("select * from products p, markets m where p.owner = m.id and title like ? and NOW() < expiry_date and LOWER(m.city) = ? ");    
        $stmt->execute(['%'.strtolower($_POST["keyword"]).'%', $buyer["city"]]) ;
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
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
    <?php if(isset($list)) var_dump($list); ?>
</body>
</html>