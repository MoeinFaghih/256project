<?php
    session_start() ;
    require "./protect.php" ;

    session_destroy() ;
    setcookie("PHPSESSID", "", 1, "/") ;

    header("location: marketLogin.php") ;