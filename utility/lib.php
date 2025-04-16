<?php
    require __DIR__ . "/../utility/db.php"  ;
    function getMarketByEmail($email, &$user){

        global $db;
        $stmt = $db->prepare("select * from markets where email = ?") ;
        $stmt->execute([$email]); 
        $user = $stmt->fetch() ;
    }