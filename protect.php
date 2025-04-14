<?php

    if(!isset($_SESSION["user"])){
        header("location: marketLogin.php") ;
        exit ; 
    }