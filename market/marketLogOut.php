<?php
    session_start() ;
    require __DIR__ . "/../utility/protect-market.php" ;

    session_destroy() ;
    setcookie("PHPSESSID", "", 1, "/") ;

    header("location: marketLogin.php") ;