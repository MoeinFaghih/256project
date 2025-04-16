<?php
    session_start() ;
    require __DIR__ . "/../utility/protect-market.php" ;
    require __DIR__ . "/../utility/db.php" ;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start() ;
        extract($_POST) ;
        $stmt = $db->prepare('Insert into products (title, stock, normal_price, discounted_price, expiry_date, owner)
                        values (?,?,?,?,?,?)') ;
        $stmt->execute([$title, $stock, $n_price, $d_price, $e_date, $_SESSION["market"]["id"]]) ;

        header('location: marketMain.php') ;
    }