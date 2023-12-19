<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: *");
include "./classes/userClass.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    session_start();
    switch ($_POST["req"]){
        case "login":
            $fileData = fopen("./data/users.json", "r");
            $data = fread($fileData, filesize("./data/users.json"));
            fclose($fileData);
            $users = json_decode($data);
            foreach ($users as $user){
                if($user['email'] == $_POST["email"] && $user['password'] == $_POST["password"]){
                    $userObj = new User(session_id(), $user['fname'], $user['lname']);
                    $_SESSION['user']= $userObj;
                    $login = true;
                    $response = ["id"=>session_id(), "fname"=>  $user['fname']];
                    echo json_encode($response);
                    exit();              
                }
            }
            if(!$login) {
                http_response_code(401);
            }
        break;
        case "menu":
            $file = fopen("./data/inventory.json", "r");
            $data = fread($file, filesize("./data/inventory.json"));
            fclose($file);
            echo $data;
            break;
        }
    }
?>
