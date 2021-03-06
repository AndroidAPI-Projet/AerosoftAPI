<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/utilisateur.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Utilisateur($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->Mail = $data->Mail;
    $item->MotDePasse = $data->MotDePasse;
    
    if($item->loginUtilisateur()){
        echo json_encode(
            array("message" => "Vous êtes connecté",
                  "IdUtilisateur" =>  $item->IdUtilisateur,
                  "Mail" => $item->Mail,
                  "MotDePasse" => $item->MotDePasse,
                  "Statut" => $item->Statut,
                  "IdRole" => $item->IdRole
            )
        );
    } else{
        echo json_encode(
            array("message" => "Mot de passe ou login erroné")
        );
    }
?>