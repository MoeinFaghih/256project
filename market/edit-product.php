<?php
    session_start();
    require __DIR__ . "/../utility/protect-market.php" ;
    require __DIR__ . "/../utility/db.php" ;
    
    if(isset($_GET["id"]) && $_SERVER['REQUEST_METHOD'] === 'GET'){    
        $stmt = $db->prepare('select * from products where id = ?') ;
        $stmt->execute([ $_GET["id"] ]) ;
        $product = $stmt->fetch(PDO::FETCH_ASSOC) ;
        extract($product) ;
    }
    if($_SERVER['REQUEST_METHOD']==='post'){
        extract($_POST) ;
        $stmt = $db->prepare('Update products set
                                title = ?,
                                stock = ?,
                                normal_price = ?,
                                discounted_price = ?,
                                expiry_date = ?    
                             where id = ?');
        $stmt->execute([$title, $stock, $n_price, $d_price, $e_date]) ;
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
    <form action="./edit-product.php" method="POST">
        <div>
            Title: <input type="text" name="title" value="<?= $title ?>">
        </div>
        <div>
            stock: <input type="text" name="stock" value="<?= $stock ?>">
        </div>
        <div>
            Normal Price: <input type="text" name="n_price" value="<?= $normal_price ?>">
        </div>
        <div>
            Discounted Price: <input type="text" name="d_price" value="<?= $discounted_price ?>">
        </div>
        <div>
            Expiry Date: <input type="text" name="e_date" value="<?= $expiry_date ?>">
        </div>
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>