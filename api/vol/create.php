<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/vol.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Vol($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->NumVol = $data->NumVol;
    $item->AeroportDept = $data->AeroportDept;
    $item->HDepart = $data->HDepart;
    $item->AeroportArr = $data->AeroportArr;
    $item->HArrivee = $data->HArrivee;
    
    if($item->createVol()){
        echo json_encode(
            array("message" => "Le vol a été créé avec succès")
        );
    } else{
        echo json_encode(
            array("message" => "Le vol n'a pas pu être créé")
        );
    }
?>