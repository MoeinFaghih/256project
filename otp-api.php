<?php
    session_start();
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (!isset($data['email'])) {
            echo json_encode(["success" => false, "message" => "No email given."]);
            exit;
        }

        $code = rand(100000, 999999); // 6-digit code
        $_SESSION['otp'] = ["code"=>$code, "expiry"=>time()+120];

        require_once './vendor/autoload.php';
        require_once './Mail.php';

        Mail::send($data['email'], "Your Verification Code", "<p>Your code is <strong>$code</strong></p>");

        echo json_encode(["success" => true, "status"=>"otp email was sent!"]);
    }
