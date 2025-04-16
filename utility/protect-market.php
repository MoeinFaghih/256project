<?php

    if(!isset($_SESSION["market"])){
        header("location: marketLogin.php") ;
        exit ; 
    }