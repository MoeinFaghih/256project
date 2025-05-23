<?php
    session_start() ;
    require __DIR__ . "/../utility/protect-market.php" ;
    require __DIR__ . "/../utility/db.php" ;
    extract($_SESSION) ;
    //var_dump($user) ;

    $stmt = $db->prepare("select * from products where owner = ?") ;
    $stmt->execute([$market["id"]]) ;
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
    //var_dump($products) ;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Market Main</h2>
    <p><?= $market["email"]?></p>
    <p><?= $market["name"]?></p>
    <p><?= $market["city"]?></p>
    <p><?= $market["district"]?></p>
    <hr>
    <form action="./market-add-product.php" method="POST">
        <div>
            Title: <input type="text" name="title">
        </div>
        <div>
            stock: <input type="text" name="stock">
        </div>
        <div>
            Normal Price: <input type="text" name="n_price">
        </div>
        <div>
            Discounted Price: <input type="text" name="d_price">
        </div>
        <div>
            Expiry Date: <input type="text" name="e_date">
        </div>
        <button type="submit">Add Product</button>
    </form>
    <hr>
    <?php if(!$products): ?>
        <p>There are no Items yet!</p>
    <?php else: ?>
        <table>
            <tr>
                <?php foreach($products as $p): ?>
                    <tr>
                        <td>
                            <?= $p["title"] ?>
                            <?= $p["stock"] ?>
                            <?= $p["normal_price"] ?>
                            <?= $p["discounted_price"] ?>
                            <?= $p["expiry_date"] ?>
                            <div class="btn"><a href="delete-product.php?id=<?=$p["product_id"]?>">Delete</a></div>
                            <div class="btn"><a href="edit-product.php?id=<?=$p["product_id"]?>">Edit</a></div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tr>
        </table>
    <?php endif ?>
    <br><br>
    <p><a href="./market-edit.php">Edit personal Info</a></p>
    <a href="./marketLogOut.php">LogOut</a>
    
</body>
</html>