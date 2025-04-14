<?php
    session_start() ;
    require "./protect.php";
    require_once "./db.php" ;
    extract($_GET) ;
    

    $stmt = $db->prepare("delete from products where id = ? and owner = ?");
    $stmt->execute([$_GET["id"], $_SESSION["user"]["id"]]) ;
    var_dump($_GET);
    var_dump($_SESSION);

    header("location: marketMain.php") ;
?>