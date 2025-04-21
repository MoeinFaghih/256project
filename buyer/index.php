<?php
    session_start() ;
    require "./protect_buyer.php" ;
    extract($_SESSION) ;
    require "../utility/db.php" ;
    $stmt = $db->prepare("select count(*) as num from cart where customer_id = ? ") ;
    $stmt->execute([$buyer["id"]]) ;
    $num = $stmt->fetch()["num"] ;

    if(isset($_POST["keyword"])){
        $stmt = $db->prepare("select * from products p, markets m where p.owner = m.id and title like ? and NOW() < expiry_date and LOWER(m.city) = ? ");    
        $stmt->execute(['%'.strtolower($_POST["keyword"]).'%', $buyer["city"]]) ;
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC) ;

        //var_dump($list) ;   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        div.header{
            display: flex;
            justify-content: space-between;
        }
        .header span {
            background-color: #ddd;
            padding: 8px;
            border-radius: 100%;
        }
        td{
            display: flex;
        }
        .addBtn {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div>
        <div class="header">
            <div>
                <?= $buyer["name"] ?>
                <br>
                <?= $buyer["city"] ?>
            </div>
            <div>
                Shopping cart <span id="cartSize"> <?= $num ?></span>
            </div>
        </div>
        <hr>
        <form action="" method="post">
            <input type="text" name="keyword">
            <button type="submit">search</button>
        </form>
    </div>
    <?php //if(isset($list)) var_dump($list); ?>
    <hr>
    <hr>
        <table>
            <tr>
                <?php if(isset($_POST["keyword"])): ?>
                <?php foreach($list as $item): ?>
                    <tr>
                        <td>
                            <?= $item["title"] ?>
                            <?= $item["stock"] ?>
                            <?= $item["normal_price"] ?>
                            <?= $item["discounted_price"] ?>
                            <?= $item["expiry_date"] ?>
                            
                            <div class="addBtn" data-id="<?= $item['product_id'] ?>">
                                <button>Add to Cart</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif ?>
            </tr>
        </table>
</body>
<script>
    $('.addBtn').on('click', function() {
        var productId = $(this).data('id');

        $.ajax({
            url: 'addProduct.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: productId }),
            success: function(response) {
                if (response.success) {
                    //alert("Product added to cart!");
                    let cartEl = $("#cartSize");
                    let current = parseInt(cartEl.text()) || 0; 
                    cartEl.text(current + 1);
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                alert("Something went wrong.");
            }
        });
    });
    </script>
</html>