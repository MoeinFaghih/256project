<?php
    session_start() ;
    require './protect.php' ;
    require_once './db.php' ;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start() ;
        extract($_POST) ;
        $stmt = $db->prepare('Insert into products (title, stock, normal_price, discounted_price, expiry_date, owner)
                        values (?,?,?,?,?,?)') ;
        $stmt->execute([$title, $stock, $n_price, $d_price, $e_date, $_SESSION["user"]["id"]]) ;

        header('location: marketMain.php') ;
    }