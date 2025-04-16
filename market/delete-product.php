<?php
    session_start() ;
    require __DIR__ . "/../utility/protect-market.php" ;
    require __DIR__ . "/../utility/db.php" ;
    extract($_GET) ;
    

    $stmt = $db->prepare("delete from products where id = ? and owner = ?");
    $stmt->execute([$_GET["id"], $_SESSION["market"]["id"]]) ;
    var_dump($_GET);
    var_dump($_SESSION);

    header("location: marketMain.php") ;
?>