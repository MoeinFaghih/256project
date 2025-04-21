<?php
    session_start();
    header("Content-Type: application/json");
    
    if(!isset($_SESSION["buyer"])){
        echo json_encode(["success" => false, "message" => "UnAuthorized."]);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (!isset($data['id'])) {
            echo json_encode(["success" => false, "message" => "No product id given."]);
            exit;
        }

        require "../utility/db.php" ;
        $stmt = $db->prepare("insert into cart values ( ? , ? )");
        $stmt->execute([$_SESSION["buyer"]["id"], $data["id"]]) ;

        
        echo json_encode(["success" => true, "status"=>"product was added!"]);
    }
