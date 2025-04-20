<?php

    if(!isset($_SESSION["buyer"])){
        header("Location: login.php");
        exit;
    }